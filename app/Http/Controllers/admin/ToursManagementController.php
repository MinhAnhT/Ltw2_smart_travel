<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ToursModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB; // THÊM DÒNG NÀY ĐỂ DÙNG DB CHO ẢNH TẠM
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ToursManagementController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new ToursModel();
    }
    public function index()
    {
        $title = 'Quản lý Tours';

        $tours = $this->tours->getAllTours();
        return view('admin.tours', compact('title', 'tours'));
    }

    public function pageAddTours()
    {
        $title = 'Thêm Tours';

        return view('admin.add-tours', compact('title'));
    }

    public function addTours(Request $request)
    {
        $name = $request->input('name');
        $destination = $request->input('destination');
        $domain = $request->input('domain');
        $quantity = $request->input('number');
        $price_adult = $request->input('price_adult');
        $price_child = $request->input('price_child');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $description = $request->input('description');


        // Chuyển start_date và end_date từ định dạng d/m/Y sang Y-m-d
        $startDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

        // Tính số ngày giữa start_date và end_date
        $days = Carbon::createFromFormat('Y-m-d', $startDate)->diffInDays(Carbon::createFromFormat('Y-m-d', $endDate));

        // Tính số đêm: số ngày - 1
        $nights = $days - 1;
        $nights = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
        $days = $nights + 1;
        // Định dạng thời gian theo kiểu "X ngày Y đêm"
        $time = "{$days} ngày {$nights} đêm";


        $dataTours = [
            'title' => $name,
            'time' => $time,
            'description' => $description,
            'quantity' => $quantity,
            'priceAdult' => $price_adult,
            'priceChild' => $price_child,
            'destination' => $destination,
            'domain' => $domain,
            'availability' => 0,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        // dd($dataTours);

        // 1. TẠO TOUR VÀ LẤY TOUR ID
        $createTour = $this->tours->createTours($dataTours);

        // dd($createTour);
        return response()->json([
            'success' => true,
            'message' => 'Tour added successfully!',
            'tourId' => $createTour // TRẢ VỀ ID CỦA TOUR VỪA TẠO
        ]);

    }

    /**
     * HÀM NÀY ĐƯỢC GỌI BỞI DROPZONE. SỬ DỤNG TEMPORARY LOGIC (tbl_temp_images)
     * VÌ tourId CHƯA ĐƯỢC TẠO RA HOẶC CHƯA CHẮC CHẮN.
     */
   public function addImagesTours(Request $request)
{
    try {
        // Debug: Xem request chứa gì
        \Log::info('addImagesTours called', [
            'has_image' => $request->hasFile('image'),
            'files' => $request->allFiles(),
            'input' => $request->all()
        ]);

        $image = $request->file('image');

        // Kiểm tra xem file có tồn tại không
        if (!$image) {
            return response()->json([
                'success' => false, 
                'message' => 'Không tìm thấy file trong request'
            ], 400);
        }

        // Kiểm tra xem file có hợp lệ không
        if (!$image->isValid()) {
            \Log::error('File is not valid', ['error' => $image->getError()]);
            return response()->json([
                'success' => false, 
                'message' => 'File không hợp lệ: ' . $image->getErrorMessage()
            ], 400);
        }

        $tourId = $request->tourId;
        if (!$tourId) {
            return response()->json([
                'success' => false, 
                'message' => 'tourId không hợp lệ'
            ], 400);
        }

        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName) . '_' . time() . '.' . $extension;

        // Resize hình ảnh
        $resizedImage = Image::make($image)->resize(400, 350);

        // Di chuyển file
        $destinationPath = public_path('admin/assets/images/gallery-tours/');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $resizedImage->save($destinationPath . $filename);

        // Lưu vào database (chú ý: column là imageUrl chứ không phải imageURL)
        $dataUpload = [
            'tourId' => $tourId,
            'imageUrl' => $filename
        ];

        $uploadImage = $this->tours->uploadImages($dataUpload);

        if ($uploadImage) {
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => [
                    'filename' => $filename,
                    'tourId' => $tourId
                ]
            ], 200);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Failed to save image data'
        ], 500);

    } catch (\Exception $e) {
        \Log::error('Error in addImagesTours: ' . $e->getMessage());
        return response()->json([
            'success' => false, 
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
    // **ĐÃ XÓA HÀM uploadTempImagesTours VÌ ĐÃ TÍCH HỢP VÀO addImagesTours**

    /**
     * HÀM NÀY LÀ BƯỚC CUỐI CÙNG (COMMIT). CẦN CHUYỂN ẢNH TỪ BẢNG TẠM SANG BẢNG CHÍNH VÀ KIỂM TRA SỐ LƯỢNG ẢNH.
     */
  // Thay thế hàm addTimeline() trong ToursManagementController.php

    public function addTimeline(Request $request)
    {
        $tourId = $request->input('tourId');
        $timelinesJson = $request->input('timelines');
        
        // Kiểm tra tourId
        if (!$tourId || $tourId == 'null') {
            return response()->json([
                'success' => false,
                'message' => 'Tour ID không hợp lệ'
            ]);
        }

        // Giải mã JSON từ timelines
        $timelines = json_decode($timelinesJson, true);

        if (empty($timelines)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng thêm lộ trình'
            ]);
        }

        // Thêm timeline từng cái một
        foreach ($timelines as $timeline) {
            $data = [
                'tourId' => (int)$tourId,
                'dayNumber' => (int)$timeline['dayNumber'],
                'title' => $timeline['title'],
                'content' => $timeline['content']
            ];

            $this->tours->addTimeLine($data);
        }

        // Cập nhật availability
        $this->tours->updateTour($tourId, ['availability' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Tour đã được thêm thành công'
        ]);
    }
public function updateTour(Request $request)
    {
        // Bắt đầu Transaction
        DB::beginTransaction();

        try {
            $tourId = $request->input('tourId');
            if (!$tourId) {
                return response()->json(['success' => false, 'message' => 'Thiếu Tour ID.'], 400);
            }

            // 1. Cập nhật thông tin Tour chính
            // Chuyển ngày về định dạng Y-m-d
            $startDate = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $request->input('end_date'))->format('Y-m-d');
            
            // Tính toán lại thời gian (time)
            $nights = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
            $days = $nights + 1;
            $time = "{$days} ngày {$nights} đêm";

            $tourData = [
                'title' => $request->input('name'), // JS gửi 'name'
                'destination' => $request->input('destination'),
                'domain' => $request->input('domain'),
                'quantity' => $request->input('number'), // JS gửi 'number'
                'priceAdult' => $request->input('price_adult'),
                'priceChild' => $request->input('price_child'),
                'startDate' => $startDate,
                'endDate' => $endDate,
                'description' => $request->input('description'),
                'time' => $time,
                'updated_at' => Carbon::now()
            ];

            $this->tours->updateTour($tourId, $tourData);

            // 2. Cập nhật Timeline
            $timelines = $request->input('timeline', []);
            
            // Xóa timeline cũ
            $this->tours->deleteData($tourId, 'tbl_timeline');

            // Thêm timeline mới
            if (!empty($timelines)) {
                $dayCounter = 1;
                foreach ($timelines as $item) {
                    $timelineData = [
                        'tourId' => $tourId,
                        'dayNumber' => $dayCounter++,
                        'title' => $item['title'],
                        'content' => $item['itinerary'] // JS gửi 'itinerary'
                    ];
                    $this->tours->addTimeLine($timelineData); // Dùng hàm addTimeLine đã có
                }
            }
            
            // 3. Cập nhật Images
            $newImageNames = $request->input('images', []); // Danh sách ảnh JS gửi
            $oldImages = $this->tours->getImages($tourId); // Lấy ảnh hiện tại từ DB

            // Xóa ảnh không còn trong danh sách mới
            foreach ($oldImages as $oldImage) {
                if (!in_array($oldImage->imageUrl, $newImageNames)) {
                    // Xóa file vật lý
                    $imagePath = public_path('admin/assets/images/gallery-tours/' . $oldImage->imageUrl);
                    if (File::exists($imagePath)) {
                        File::delete($imagePath);
                    }
                    // Xóa trong DB (ToursModel cần có hàm này)
                    $this->tours->deleteImage($oldImage->imageId); // Giả sử có hàm deleteImage(imageId)
                }
            }
            // (Lưu ý: Logic thêm ảnh mới đã được xử lý bằng Dropzone khi upload)

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật tour thành công!',
            ]);

        } catch (\Exception $e) {
            // Nếu có lỗi, rollback
            DB::rollBack();
            Log::error('Lỗi updateTour: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
   public function getTourEdit($tourId)
    {
    // Sử dụng các phương thức đã có trong Model để lấy dữ liệu
    $tour = $this->tours->getTour($tourId);

    // Kiểm tra nếu không tìm thấy tour
    if (!$tour) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy tour!'], 404);
    }
    
        $images = $this->tours->getImages($tourId);
        $timeline = $this->tours->getTimeLine($tourId);

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'success' => true,
            'tour' => $tour,
            'images' => $images,
            'timeline' => $timeline
        ]);
    }
     public function deleteTour(Request $request)
    {
        $tourId = $request->tourId;

        $result = $this->tours->deleteTour($tourId); // Model giờ trả về mảng
        $tours = $this->tours->getAllTours();

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => view('admin.partials.list-tours', compact('tours'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result['message']
            ]);
        }
    }
}