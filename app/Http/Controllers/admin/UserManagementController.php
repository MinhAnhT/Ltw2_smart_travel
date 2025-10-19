<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{

    private $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }
    public function index(Request $request) // <-- THÊM Request $request
    {
        $title = 'Quản lý người dùng';

        // 1. Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // 2. Bắt đầu query từ Model
        // (Giả sử UserModel của bạn dùng Eloquent, nếu không bạn cần sửa lại hàm trong Model)
        $query = $this->users->query(); // Bắt đầu một query mới

        // 3. Nếu có tìm kiếm, thêm điều kiện WHERE
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('fullname', 'LIKE', "%{$search}%")
                  ->orWhere('username', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%") // Giả sử bạn có cột email
                  ->orWhere('phone', 'LIKE', "%{$search}%"); // Giả sử bạn có cột phone
            });
        }
        
        // 4. Lấy kết quả CÓ PHÂN TRANG (12 user mỗi trang)
        // Sắp xếp theo userId giảm dần để thấy user mới nhất
        $users = $query->orderBy('userId', 'desc')->paginate(12);

        // 5. Xử lý thông tin phụ (fullname, avatar, statusText)
        foreach ($users as $user) {
            if (!$user->fullname) {
                $user->fullname = "Unnamed";
            }
            if (!$user->avatar) {
                $user->avatar = 'unnamed.png';
            }

            switch ($user->isActive) {
                case 'y':
                    $user->statusText = 'Đã kích hoạt';
                    break;
                case 'b':
                    $user->statusText = 'Đã chặn';
                    break;
                case 'd':
                    $user->statusText = 'Đã xóa';
                    break;
                case 'n':
                default:
                    $user->statusText = 'Chưa kích hoạt';
            }
        }
        // dd($users);

        return view('admin.users', compact('title', 'users'));
    }

    public function activeUser(Request $request)
    {
        $userId = $request->userId;

        $updateActive = $this->users->updateActive($userId);

        if ($updateActive) {
            return response()->json([
                'success' => true,
                'message' => 'Người dùng đã được kích hoạt thành công!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kích hoạt người dùng!'
            ], 500); // Trả về mã lỗi HTTP 500 nếu có lỗi
        }
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->userId;
        $status = $request->status;

        // SỬA LỖI 2: Cập nhật cột 'isActive', không phải cột 'status'
        $dataUpdate = [
            'isActive' => $status
        ];

        $changeStatus = $this->users->changeStatus($userId, $dataUpdate);
        $statusText = $this->getStatusText($status);
        if ($changeStatus) {
            return response()->json([
                'success' => true,
                'status' => $statusText,
                'message' => "Trạng thái người dùng đã được cập nhật thành công!"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Có lỗi xảy ra khi cập nhật trạng thái người dùng!"
            ], 500); // Trả về mã lỗi HTTP 500 nếu có lỗi
        }
    }

    private function getStatusText($status)
    {
        // Bổ sung thêm các trạng thái
        switch ($status) {
            case 'b':
                return 'Đã chặn';
            case 'd':
                return 'Đã xóa';
            case 'n':
                return 'Chưa kích hoạt'; // Trạng thái khôi phục
            case 'y':
                return 'Đã kích hoạt';
            default:
                return 'Chưa kích hoạt';
        }
    }
}