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
        foreach ($classes as $value) {
            $da_danh_gia = DB::select('SELECT count(*) as da_danh_gia
                                        from lop_mon_hoc lmh
                                        JOIN mon_hoc mh ON lmh.ma_mh = mh.ma_mh
                                        JOIN giang_vien gv ON mh.gv_id = gv.id
                                        WHERE mh.gv_id=? AND lmh.da_danh_gia != 0
                                        GROUP BY lmh.ma_mh',[$teacher->id]);
            $da_danh_gia = $da_danh_gia[0]->da_danh_gia;
            $value->da_danh_gia = $da_danh_gia;                 
        }
        //return json_encode($classes);
        return view('teacher.home',compact(['classes']));
    }
}
