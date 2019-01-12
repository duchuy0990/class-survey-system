<?php

namespace App\Imports;

use App\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function model(array $row)
    {
            // echo json_encode($row ['Mã sinh viên/Tên đăng nhập']);
            $username = trim($row['Mã sinh viên']);
            $password = trim($row['Mật khẩu']);
            $ho_ten = trim($row['Họ và tên']);
            $email = trim($row['VNU email']);
            $lkh = trim($row['Khóa đào tạo']);
            return new Student([
                'username' =>$username,
                'password'=>bcrypt($password),
                'ho_ten' =>$ho_ten,
                'email'=>$email,
                'lop_khoa_hoc'=>$lkh,
            ]);
    }
}
