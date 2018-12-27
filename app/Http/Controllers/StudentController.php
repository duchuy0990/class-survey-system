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
class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        $student = Auth::user();
        $classes = DB::select('SELECT mh.ma_mh, mh.ten_mh, gv.ho_ten, lmh.da_danh_gia
                    FROM lop_mon_hoc lmh
                    JOIN mon_hoc mh ON lmh.ma_mh = mh.ma_mh
                    JOIN giang_vien gv ON mh.gv_id = gv.id
                    WHERE lmh.id_sv = ?', [$student->id]);
        return view('student.home',compact(['classes']));
    }

    /**
     * Select phiếu khảo sát
     * @return view đánh giá
     */
    public function getDanhGia($ma_mh) {
        $info_mh = mon_hoc::where('ma_mh','=',$ma_mh)->get();
        $phieu_khao_sat = array();
        $category = category_survey::all();
        $da_danh_gia = DB::select(' SELECT da_danh_gia
                                    FROM lop_mon_hoc
                                    WHERE id_sv = ? AND ma_mh = ?',[Auth::id(),$ma_mh]);
        $da_danh_gia = $da_danh_gia[0]->da_danh_gia;
        foreach ($category as $item) {
            $phieu_khao_sat[$item->ten_category] = $item->survey;
        }
        return view('student.danh_gia',compact(['phieu_khao_sat','info_mh','da_danh_gia']));
    }

    /**
     * Xử lý form đánh giá môn học từ client
     * form danh gia:   + ma_mh : ma:mh
     *                  + ma_phieu 1-n : diem
     * Insert vào database
     * @return redirect home
     */
    public function postDanhGia(Request $request) {
        $ma_mh = $request->ma_mh;
        $data_mark = array();
        foreach ($request->input() as $item => $mark) {
            if($item === "ma_mh" || $item === "_token") {
                continue;
            }
            else {
                $data_mark[substr($item,1)] = $mark;
            }
        }
        DB::beginTransaction();
        foreach ($data_mark as $item => $mark) {
            DB::insert('insert into diem_ks (id_sv, ma_phieu, ma_mh, diem) 
                        values (?, ?, ?, ?)', [Auth::user()->id, $item, $ma_mh, $mark]);
        }
        DB::commit();
        return redirect('student/danh_gia/status/done');
    }

    /**
     * xử lý form đánh giá môn học từ client
     * update database
     */
    public function postDanhGiaLai(Request $request){
        $ma_mh = $request->ma_mh;
        $data_mark = array();
        foreach ($request->input() as $item => $mark) {
            if($item === "ma_mh" || $item === "_token") {
                continue;
            }
            else {
                $data_mark[substr($item,1)] = $mark;
            }
        }
        DB::beginTransaction();
        foreach ($data_mark as $item => $mark) {
            DB::update('update diem_ks set diem = ? where ma_phieu = ? and ma_mh = ? and id_sv=?', [$mark, $item, $ma_mh, Auth::user()->id, ]);
        }
        DB::commit();
        $request->session()->put('success','đánh giá hoàn tất. Xin cám ơn! Sau 3s hệ thống sẽ tự động đưa bạn về trang chủ');
        return redirect('student/danh_gia/status/done');
    }

    public function mark_info($ma_mh) {
        $mark_info = DB::select('SELECT ma_phieu, diem
                    FROM diem_ks
                    WHERE id_sv = ? AND ma_mh = ?',[Auth::id(), $ma_mh]);
        return json_encode($mark_info);
    }

    public function danh_gia_xong() {
        return view('student.danh_gia_xong');
    }
}
