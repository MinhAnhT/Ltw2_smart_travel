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
    public function index()
    {
        $title = 'Quản lý người dùng';

        $users = $this->users->getAllUsers();

        foreach ($users as $user) {
            if (!$user->fullname) {
                $user->fullname = "Unnamed";
            }
            if (!$user->avatar) {
                $user->avatar = 'unnamed.png';
            }

            // SỬA LỖI 1: TẠO BIẾN MỚI 'statusText' VÀ KHÔNG GHI ĐÈ 'isActive'
            // 'isActive' gốc (y, n, b, d) phải được giữ nguyên để view xử lý logic
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