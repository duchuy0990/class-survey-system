<?php

namespace App\Imports;

use App\ClassStudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class StudentsClassImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ClassStudent([
            'MaSV' => $row['Mã SV'],
            'HoVaTen' => $row['Họ và tên'],
            'NgaySinh' => $row['Ngày sinh'],
            'LopKhoaHoc' => $row['Lớp khóa học'],
        ]);
    }

}
