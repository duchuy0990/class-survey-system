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
            return new Student([
                'username' =>$row['Mã sinh viên'],
                'password'=>$row['Mật khẩu'],
                'ho_ten' =>$row['Họ và tên'],
                'email'=>$row['VNU email'],
                'lop_khoa_hoc'=>$row['Khóa đào tạo'],
            ]);
    }
}
