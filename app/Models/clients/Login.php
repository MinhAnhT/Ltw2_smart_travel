<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;

    protected $table = 'tbl_users';

    //Đăng ký người dùng mới
    public function registerAcount($data)
    {
        $userId = DB::table($this->table)->insertGetId($data);

        if ($userId) {
            return DB::table($this->table)->where('userId', $userId)->first();
        }

        return null;
    }
    //Kiểm tra username or email người dùng đã tồn tại hay chưa return true false
    public function checkUserExist($username, $email)
    {
        $check = DB::table($this->table)
            ->where('username', $username)
            ->orWhere('email', $email)
            ->exists();

        return $check;
    }

   
    public function login($account)
    {
        $getUser = DB::table($this->table)
            ->where('username', $account['username'])
            ->where('password', $account['password'])
            ->first();

        return $getUser;
    }


    //Login with google
    public function checkUserExistGoogle($google_id)
    {
        $check = DB::table($this->table)
            ->where('google_id', $google_id)->first();

        return $check;
    }
}
