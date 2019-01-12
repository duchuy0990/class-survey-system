<?php

namespace App\Exports;

use App\lop_mon_hoc;
use App\Teacher;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class dssvExport implements FromView
{
    protected $ma_mh;
    public function __construct($ma_mh)
    {
        $this->ma_mh = $ma_mh;
    }
    public function view(): View
    {
        // danh sách sinh viên
        $lssv = DB::select('SELECT sv.ho_ten as sv_name, sv.username as sv_msv, 
                                    sv.lop_khoa_hoc as sv_lop, sv.email as sv_email, lmh.da_danh_gia
                            FROM lop_mon_hoc lmh
                            JOIN sinh_vien sv ON lmh.id_sv = sv.id
                            WHERE lmh.ma_mh = ?',[$this->ma_mh]);
        return view('layouts.dssv', compact(['lssv']));
    }

}
