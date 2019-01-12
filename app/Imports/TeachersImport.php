<?php

namespace App\Imports;

use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class TeachersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $username = trim($row['Tên đăng nhập']);
        $password = trim($row['Mật khẩu']);
        $ho_ten = trim($row['Họ và tên']);
        $email = trim($row['VNU email']);
        return new Teacher([
            'username' => $username,
            'password' => bcrypt($password),
            'ho_ten' => $ho_ten,
            'email' => $email,
        ]);
    }
}
