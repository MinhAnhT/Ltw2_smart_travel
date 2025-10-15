<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ToursModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_tours';

    public function getAllTours()
    {
        return DB::table($this->table)
            ->orderBy('tourId', 'DESC')
            ->get();
    }

    public function createTours($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function uploadImages($data)
    {
        return DB::table('tbl_images')->insert($data);
    }

    public function uploadTempImages($data)
    {
        return DB::table('tbl_temp_images')->insert($data);
    }

    public function updateTour($tourId,$data){
        $updated = DB::table($this->table)
        ->where('tourId',$tourId)
        ->update($data);

        return $updated;
    }
    

    public function deleteData($tourId, $tbl){
        return DB::table($tbl)->where('tourId', $tourId)->delete();
    }
    public function getTempImages($sessionId)
    {
        // Giả sử khi upload, bạn lưu một trường nào đó (ví dụ: 'sessionId') để nhóm các ảnh tạm
        return DB::table('tbl_temp_images')->where('sessionId', $sessionId)->get();
    }

    public function deleteTempImage($filename, $sessionId)
    {
        // Xóa bản ghi trong bảng tbl_temp_images dựa trên tên file và Session ID
        return DB::table('tbl_temp_images')
            ->where('imageTempURL', $filename)
            ->where('sessionId', $sessionId)
            ->delete();
    }
    public function moveTempImagesToPermanent($tourId, $sessionId)
    {
        // 1. Lấy tất cả ảnh tạm bằng sessionId
        $tempImages = DB::table('tbl_temp_images')->where('sessionId', $sessionId)->get();

        if ($tempImages->isEmpty()) {
            return true; // Không có ảnh nào để chuyển
        }

        // 2. Chuyển đổi dữ liệu và insert vào bảng chính (tbl_images)
        $dataToInsert = [];
        foreach ($tempImages as $image) {
            $dataToInsert[] = [
                'tourId' => $tourId,
                'imageUrl' => $image->imageTempURL,
                'description' => '' // Hoặc giá trị mặc định nào đó
            ];
        }

        DB::table('tbl_images')->insert($dataToInsert);

        // 3. Xóa các bản ghi tạm thời
        DB::table('tbl_temp_images')->where('sessionId', $sessionId)->delete();
        return true;

    }
    // CÁC PHƯƠNG THỨC BỊ THIẾU MÀ CONTROLLER CẦN
    public function getTour($tourId){
        return DB::table($this->table)->where('tourId', $tourId)->first();
    }

    public function getImages($tourId){
        return DB::table('tbl_images')->where('tourId', $tourId)->get();
    }

    public function getTimeLine($tourId){
        return DB::table('tbl_timeline')->where('tourId', $tourId)->get();
    }
    
    // Đảm bảo phương thức deleteTour() được hoàn chỉnh (xóa tour chính)
    public function deleteTour($tourId)
    {
        // Bắt đầu một transaction để đảm bảo toàn vẹn dữ liệu
        DB::beginTransaction();

        try {
            // Lấy danh sách ảnh để xóa file vật lý
            $images = DB::table('tbl_images')->where('tourId', $tourId)->get();
            foreach ($images as $image) {
                $imagePath = public_path('admin/assets/images/gallery-tours/' . $image->imageUrl);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Xóa các dữ liệu liên quan trong DB
            DB::table('tbl_timeline')->where('tourId', $tourId)->delete();
            DB::table('tbl_images')->where('tourId', $tourId)->delete();
            
            // Xóa tour chính
            DB::table($this->table)->where('tourId', $tourId)->delete(); 

            // Nếu tất cả thành công, commit transaction
            DB::commit();

            return ['success' => true, 'message' => 'Xóa tour thành công!'];

        } catch (\Exception $e) {
            // Nếu có lỗi, rollback tất cả các thay đổi
            DB::rollBack();
            Log::error('Lỗi xóa tour: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Đã xảy ra lỗi trong quá trình xóa.'];
        }
    }

    public function addTimeLine($data)
    {
        // Đảm bảo rằng dayNumber, title, và content được thiết lập
        $timelineData = [
            'tourId' => $data['tourId'] ?? null,
            'dayNumber' => (int)($data['dayNumber'] ?? 1),
            'title' => $data['title'] ?? '',
            'description' => $data['description'] ?? null,  // field này có thể null
            'content' => $data['content'] ?? ''
        ];

        return DB::table('tbl_timeline')->insert($timelineData);
    }

}
