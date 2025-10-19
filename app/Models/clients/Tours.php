<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tours extends Model
{
    use HasFactory;

    protected $table = 'tbl_tours';

    //Lấy tất cả tours
    public function getAllTours($perPage = 9)
    {

        $allTours = DB::table($this->table)->where('availability', 1)->paginate($perPage);
        foreach ($allTours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            // Lấy số lượng đánh giá và số sao trung bình của tour
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }

        return $allTours;
    }
    //Lấy chi tiết tour
    public function getTourDetail($id)
    {
        $getTourDetail = DB::table($this->table)
            ->where('tourId', $id)
            ->first();

        if ($getTourDetail) {
            // Lấy danh sách hình ảnh thuộc về tour
            $getTourDetail->images = DB::table('tbl_images')
                ->where('tourId', $getTourDetail->tourId)
                ->limit(5)
                ->pluck('imageUrl');

            // Lấy danh sách timeline thuộc về tour
            $getTourDetail->timeline = DB::table('tbl_timeline')
                ->where('tourId', $getTourDetail->tourId)
                ->get();
        }


        return $getTourDetail;
    }

    //Lấy khu vực đến Bắc - Trung - Nam
    function getDomain()
    {
        return DB::table($this->table)
            ->select('domain', DB::raw('COUNT(*) as count'))
            ->where('availability', 1)
            ->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')
            ->get();
    }

    //Filter tours
    public function filterTours($filters = [], $sorting = null, $perPage = null)
    {
        DB::enableQueryLog();

        // Khởi tạo truy vấn với bảng tours
        $getTours = DB::table($this->table)
            ->leftJoin('tbl_reviews', 'tbl_tours.tourId', '=', 'tbl_reviews.tourId') // Join với bảng reviews
            ->select(
                'tbl_tours.tourId',
                'tbl_tours.title',
                'tbl_tours.description',
                'tbl_tours.priceAdult',
                'tbl_tours.priceChild',
                'tbl_tours.time',
                'tbl_tours.destination',
                'tbl_tours.quantity',
                DB::raw('AVG(tbl_reviews.rating) as averageRating')
            )
            ->groupBy(
                'tbl_tours.tourId',
                'tbl_tours.title',
                'tbl_tours.description',
                'tbl_tours.priceAdult',
                'tbl_tours.priceChild',
                'tbl_tours.time',
                'tbl_tours.destination',
                'tbl_tours.quantity'
            );
        $getTours = $getTours->where('availability', 1);

        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if ($filter[0] !== 'averageRating') {
                    $getTours = $getTours->where($filter[0], $filter[1], $filter[2]);
                }
            }
        }

        // Áp dụng điều kiện về averageRating trong phần HAVING
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if ($filter[0] === 'averageRating') {
                    $getTours = $getTours->having('averageRating', $filter[1], $filter[2]); // Sử dụng HAVING để lọc averageRating
                }
            }
        }

        if (!empty($sorting) && isset($sorting[0]) && isset($sorting[1])) {
            $getTours = $getTours->orderBy($sorting[0], $sorting[1]);
        }

        // Thực hiện truy vấn để ghi log
        $tours = $getTours->get();

        // In ra câu lệnh SQL đã ghi lại (nếu cần thiết)
        $queryLog = DB::getQueryLog();

        // Lấy danh sách hình ảnh cho mỗi tour
        foreach ($tours as $tour) {
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }

        // dd($queryLog); // In ra log truy vấn nếu cần thiết
        return $tours;
    }

    public function updateTours($tourId, $data)
    {
        $update = DB::table($this->table)
            ->where('tourId', $tourId)
            ->update($data);

        return $update;
    }

    //Lấy detail tour đã đặt
    public function tourBooked($bookingId, $checkoutId)
    {
        $booked = DB::table($this->table)
            ->join('tbl_booking', 'tbl_tours.tourId', '=', 'tbl_booking.tourId')
            ->join('tbl_checkout', 'tbl_booking.bookingId', '=', 'tbl_checkout.bookingId')
            ->where('tbl_booking.bookingId', '=', $bookingId)
            ->where('tbl_checkout.checkoutId', '=', $checkoutId)
            ->first();

        return $booked;
    }


    //Tạo đánh giá về tours
    public function createReviews($data)
    {
        return DB::table('tbl_reviews')->insert($data);
    }

    //Lấy danh sách nội dung reviews 
    public function getReviews($id)
    {
        $getReviews = DB::table('tbl_reviews')
            ->join('tbl_users', 'tbl_users.userId', '=', 'tbl_reviews.userId')
            ->where('tourId', $id)
            ->orderBy('tbl_reviews.timestamp', 'desc')
            ->take(3)
            ->get();

        return $getReviews;
    }

    //Lấy số lượng đánh giá và số sao trung bình của tour
    public function reviewStats($id)
    {
        $reviewStats = DB::table('tbl_reviews')
            ->where('tourId', $id)
            ->selectRaw('AVG(rating) as averageRating, COUNT(*) as reviewCount')
            ->first();

        return $reviewStats;
    }

    //Kiểm tra xem người dùng đã đánh giá tour này hay chưa?

    public function checkReviewExist($tourId, $userId)
    {
        return DB::table('tbl_reviews')
            ->where('tourId', $tourId)
            ->where('userId', $userId)
            ->exists(); // Trả về true nếu bản ghi tồn tại, false nếu không tồn tại
    }

    //Search tours
    public function searchTours($data)
    {
        $tours = DB::table($this->table);


        // Thêm điều kiện cho destination với LIKE
        if (!empty($data['destination'])) {
            $tours->where('destination', 'LIKE', '%' . $data['destination'] . '%');
        }

        // Thêm điều kiện cho startDate và endDate nếu cần so sánh
        if (!empty($data['startDate'])) {
            $tours->whereDate('startDate', '>=', $data['startDate']);
        }
        if (!empty($data['endDate'])) {
            $tours->whereDate('endDate', '<=', $data['endDate']);
        }

        // Thêm điều kiện tìm kiếm với LIKE cho title, time và description
        if (!empty($data['keyword'])) {
            $tours->where(function ($query) use ($data) {
                $query->where('title', 'LIKE', '%' . $data['keyword'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $data['keyword'] . '%')
                    ->orWhere('time', 'LIKE', '%' . $data['keyword'] . '%')
                    ->orWhere('destination', 'LIKE', '%' . $data['keyword'] . '%');
            });
        }

        $tours = $tours->where('availability', 1);
        $tours = $tours->limit(12)->get();

        foreach ($tours as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            // Lấy số lượng đánh giá và số sao trung bình của tour
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }
        return $tours;
    }

    //Get tours recommendation
    public function toursRecommendation($ids)
    {

        if (empty($ids)) {
            // Return an empty collection to avoid executing the query with an empty `FIELD` clause
            return collect();
        }

        $toursRecom = DB::table($this->table)
            ->where('availability', '1')
            ->whereIn('tourId', $ids)
            ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
            ->get();
        foreach ($toursRecom as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            // Lấy số lượng đánh giá và số sao trung bình của tour
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }

        return $toursRecom;
    }

    //Get tour có số lượng booking và hoàn thành nhiều nhất để gợi ý
    public function toursPopular($quantity)
    {
        $toursPopular = DB::table('tbl_booking')
            ->select(
                'tbl_tours.tourId',
                'tbl_tours.title',
                'tbl_tours.description',
                'tbl_tours.priceAdult',
                'tbl_tours.priceChild',
                'tbl_tours.time',
                'tbl_tours.destination',
                'tbl_tours.quantity',
                DB::raw('COUNT(tbl_booking.tourId) as totalBookings')
            )
            ->join('tbl_tours', 'tbl_booking.tourId', '=', 'tbl_tours.tourId')
            ->where('tbl_booking.bookingStatus', 'f') // Chỉ lấy các booking đã hoàn thành
            ->groupBy(
                'tbl_tours.tourId',
                'tbl_tours.title',
                'tbl_tours.description',
                'tbl_tours.priceAdult',
                'tbl_tours.priceChild',
                'tbl_tours.time',
                'tbl_tours.destination',
                'tbl_tours.quantity'
            )
            ->orderBy('totalBookings', 'DESC')
            ->take($quantity)
            ->get();


        foreach ($toursPopular as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            // Lấy số lượng đánh giá và số sao trung bình của tour
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }
        return $toursPopular;
    }

    //Get id search tours
    public function toursSearch($ids)
    {

        if (empty($ids)) {
            // Return an empty collection to avoid executing the query with an empty `FIELD` clause
            return collect();
        }

        $tourSearch = DB::table($this->table)
            ->where('availability', '1')
            ->whereIn('tourId', $ids)
            ->orderByRaw("FIELD(tourId, " . implode(',', array_map('intval', $ids)) . ")") // Chuyển tất cả các giá trị sang kiểu int và giữ thứ tự
            ->get();
        foreach ($tourSearch as $tour) {
            // Lấy danh sách hình ảnh thuộc về tour
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl');
            // Lấy số lượng đánh giá và số sao trung bình của tour
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating;
        }

        return $tourSearch;
    }
    /**
     * Tìm các tour dựa trên tên địa điểm (destination)
     * @param string $destinationName Tên địa điểm (ví dụ: 'hà giang')
     * @return \Illuminate\Support\Collection Trả về danh sách các tour tìm được
     */
    public function findToursByDestination($destinationName)
    {
        // Sử dụng LIKE để tìm kiếm gần đúng trong cột destination
        // Lấy tối đa 3 tour để tránh trả về quá nhiều
        return DB::table($this->table)
                 ->where('destination', 'LIKE', '%' . $destinationName . '%')
                 ->where('availability', 1) // Chỉ lấy tour đang hoạt động
                 ->orderBy('startDate', 'desc') // Ưu tiên tour mới hơn
                 ->limit(3) // Giới hạn số lượng kết quả
                 ->get();
    }
    /**
     * Tìm các tour dựa trên nhiều tiêu chí
     * @param array $criteria Mảng chứa các tiêu chí ['destination' => ..., 'max_price' => ..., 'duration_days' => ...]
     * @return \Illuminate\Support\Collection
     */
    public function findToursByCriteria($criteria)
    {
        $query = DB::table($this->table)->where('availability', 1); // Bắt đầu với query cơ bản

        // 1. Thêm điều kiện địa điểm (bắt buộc phải có trong logic Controller hiện tại)
        if (!empty($criteria['destination'])) {
            $query->where('destination', 'LIKE', '%' . $criteria['destination'] . '%');
        }

        // 2. Thêm điều kiện giá tối đa (nếu có)
        if (!empty($criteria['max_price'])) {
            // So sánh với giá người lớn
            $query->where('priceAdult', '<=', $criteria['max_price']);
        }

        // 3. Thêm điều kiện thời gian (nếu có)
        // Lưu ý: Cột 'time' của bạn đang là dạng text (ví dụ: "3 ngày 2 đêm").
        // Việc lọc chính xác theo số ngày sẽ phức tạp hơn.
        // Cách đơn giản nhất là tìm chuỗi con, ví dụ tìm "3 ngày".
        if (!empty($criteria['duration_days'])) {
            $query->where('time', 'LIKE', '%' . $criteria['duration_days'] . ' ngày%');
        }

        // Sắp xếp và giới hạn kết quả
        return $query->orderBy('startDate', 'desc')
                     ->limit(3) // Vẫn giới hạn 3 kết quả
                     ->get();
    }
   /**
     * Tìm các tour tương tự dựa trên cùng điểm đến chính (destination)
     * @param int $currentTourId ID của tour đang xem (để loại trừ chính nó)
     * @param string $destination Chuỗi destination đầy đủ của tour đang xem
     * @param int $limit Số lượng tour tương tự muốn lấy
     * @return \Illuminate\Support\Collection
     */
    public function findSimilarToursByDestination($currentTourId, $destination, $limit = 3)
    {
        // Cố gắng tách lấy tên địa danh chính (phần trước dấu '–')
        // Ví dụ: "Hà Giang – Quản Bạ..." -> "Hà Giang"
        $parts = explode('–', $destination); // Tách chuỗi bằng dấu '–' (chú ý đây là en dash, không phải gạch ngang thường)
        $mainLocation = trim($parts[0]); // Lấy phần đầu tiên và xóa khoảng trắng thừa

        // Nếu không tách được hoặc phần đầu rỗng, dùng tạm chuỗi gốc (ít chính xác hơn)
        if (empty($mainLocation)) {
            $mainLocation = $destination;
        }

        // --- Bắt đầu truy vấn ---
        $query = DB::table($this->table)
            // Tìm các tour có destination BẮT ĐẦU BẰNG tên địa danh chính
            // Hoặc chứa tên địa danh chính (linh hoạt hơn)
             ->where(function ($q) use ($mainLocation) {
                 $q->where('destination', 'LIKE', $mainLocation . '%') // Bắt đầu bằng...
                   ->orWhere('destination', 'LIKE', '%' . $mainLocation . '%'); // Hoặc chứa... (tùy chọn)
             })
            ->where('tourId', '!=', $currentTourId) // Loại trừ tour đang xem
            ->where('availability', 1) // Chỉ lấy tour đang hoạt động
            ->orderByRaw('CASE WHEN destination LIKE ? THEN 0 ELSE 1 END, startDate DESC', [$mainLocation . '%']) // Ưu tiên tour bắt đầu bằng tên chính xác
            ->limit($limit); // Giới hạn số lượng

        $similarTours = $query->get();
        // --- Kết thúc truy vấn ---

        // Lấy thêm ảnh và rating (giữ nguyên như cũ)
        foreach ($similarTours as $tour) {
            $tour->images = DB::table('tbl_images')
                ->where('tourId', $tour->tourId)
                ->limit(1)
                ->pluck('imageUrl');
            $tour->rating = $this->reviewStats($tour->tourId)->averageRating ?? 0;
            $tour->rating = round($tour->rating, 1);
        }

        return $similarTours;
    }
}
