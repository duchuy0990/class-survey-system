<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsClassImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // cột mã môn học
        $ma_mh = $collection[8][2];
        // Lấy ra id từ tên gv
        $id_gv = DB::table('giang_vien')->where('ho_ten', '=', $collection[6][2])->select('id')->get();
        //thêm môn h?c
        DB::table('mon_hoc')->insert([
            [   'gv_id' => $id_gv[0]->id,
                'ma_mh' => $ma_mh,
                'ten_mh' => $collection[9][2],
            ]
        ]);
        // vòng lặp danh sách sv lớp mh
        for ($i = 11; $i < count($collection); $i++) {
            // g?p dòng r?ng thì d?ng
            if ($collection[$i][2] === null) {
                break;
            }
            //Lấy id sv từ msv
            $id_sv = DB::table('sinh_vien')->where('username', '=', $collection[$i][1])->select('id')->get();
            DB::table('lop_mon_hoc')->insert([
                ['id_sv' => $id_sv[0]->id,
                    'ma_mh' => $ma_mh,
                ]
            ]);
        }
    }
}
