<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\lop_mon_hoc;
use App\mon_hoc;
use App\Student;
use App\category_survey;
use App\survey;
use App\Teacher;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $teacher = Auth::user();
        $classes = DB::select('SELECT mh.ma_mh, mh.ten_mh, gv.ho_ten, count(*) as total_sv
                                FROM lop_mon_hoc lmh
                                JOIN mon_hoc mh ON lmh.ma_mh = mh.ma_mh
                                JOIN giang_vien gv ON mh.gv_id = gv.id
                                WHERE mh.gv_id = ?
                                GROUP BY lmh.ma_mh', [$teacher->id]);
        $da_danh_gia = DB::select('SELECT count(*) as da_danh_gia
                                    FROM lop_mon_hoc lmh
                                    JOIN mon_hoc mh ON lmh.ma_mh = mh.ma_mh
                                    JOIN giang_vien gv ON mh.gv_id = gv.id
                                    WHERE mh.gv_id=? AND lmh.da_danh_gia != 0
                                    GROUP BY lmh.ma_mh',[$teacher->id]);
        for($i = 0; $i<count($classes);$i++) {
            $classes[$i]->da_danh_gia = $da_danh_gia[$i]->da_danh_gia;
        }
        //return json_encode($classes);
        return view('teacher.home',compact(['classes']));
    }

    public function result($ma_mh) {
        //tính số sv của lớp học
        $total = lop_mon_hoc::where('ma_mh','=',$ma_mh)->get()->count();
        // tính điểm trung bình của lớp học
        $result = DB::select('SELECT pks.ma_phieu, pks.ndung_phieu_ks, AVG(diem) as dtb 
                                FROM diem_ks 
                                JOIN phieu_khao_sat pks ON diem_ks.ma_phieu = pks.ma_phieu
                                WHERE diem_ks.ma_mh = ?
                                GROUP BY diem_ks.ma_phieu', [$ma_mh]);
        foreach ($result as $item) {
            $greater_5 = DB::select('SELECT count(*) as greater_5 FROM diem_ks WHERE ma_phieu = ? AND ma_mh = ? AND diem > 5',[$item->ma_phieu, $ma_mh]);
            $item->greater_5 = $greater_5[0]->greater_5*100/$total;
        }
        // danh sách sinh viên
        $lssv = DB::select('SELECT sv.ho_ten as sv_name, sv.username as sv_msv, 
                                    sv.lop_khoa_hoc as sv_lop, sv.email as sv_email, lmh.da_danh_gia
                            FROM lop_mon_hoc lmh
                            JOIN sinh_vien sv ON lmh.id_sv = sv.id
                            WHERE lmh.ma_mh = ?',[$ma_mh]);

        // tên môn học
        $mh_info = DB::select('SELECT * FROM mon_hoc WHERE ma_mh=? ', [$ma_mh]); 

        // tên giảng viên
        $ten_gv = (DB::select("SELECT gv.ho_ten as ten_gv
                                FROM mon_hoc mh
                                JOIN giang_vien gv ON mh.gv_id = gv.id
                                WHERE mh.ma_mh=?", [$ma_mh]));
                                // echo json_encode($mh_info);
        return view('teacher.ket_qua', compact(['result','lssv','mh_info','ten_gv']));
    }
}
