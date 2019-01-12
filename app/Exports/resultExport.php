<?php

namespace App\Exports;

use App\lop_mon_hoc;
use App\Teacher;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class resultExport implements FromView
{
    protected $ma_mh;
    public function __construct($ma_mh)
    {
        $this->ma_mh = $ma_mh;
    }
    public function view(): View
    {
        //tính số sv của lớp học
        $total = lop_mon_hoc::where('ma_mh','=',$this->ma_mh)->get()->count();
        // tính điểm trung bình của lớp học
        $result = DB::select('SELECT pks.ma_phieu, pks.ndung_phieu_ks, AVG(diem) as dtb 
                                FROM diem_ks 
                                JOIN phieu_khao_sat pks ON diem_ks.ma_phieu = pks.ma_phieu
                                WHERE diem_ks.ma_mh = ?
                                GROUP BY diem_ks.ma_phieu', [$this->ma_mh]);
        foreach ($result as $item) {
            $greater_5 = DB::select('SELECT count(*) as greater_5 FROM diem_ks WHERE ma_phieu = ? AND ma_mh = ? AND diem > 5',[$item->ma_phieu, $this->ma_mh]);
            $item->greater_5 = $greater_5[0]->greater_5*100/$total;
        }
        // tên môn học
        $mh_info = DB::select('SELECT * FROM mon_hoc WHERE ma_mh=? ', [$this->ma_mh]); 

        // tên giảng viên
        $ten_gv = (DB::select("SELECT gv.ho_ten as ten_gv
                                FROM mon_hoc mh
                                JOIN giang_vien gv ON mh.gv_id = gv.id
                                WHERE mh.ma_mh=?", [$this->ma_mh]));
                                // echo json_encode($mh_info);
        return view('layouts.ket_qua_excel', compact(['result','mh_info','ten_gv']));
    }

}
