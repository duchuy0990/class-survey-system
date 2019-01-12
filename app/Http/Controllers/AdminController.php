<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\teacherUpdateInfo;
use App\Http\Requests\studentUpdateInfo;
use DB;
use App\lop_mon_hoc;
use App\mon_hoc;
use App\Student;
use App\category_survey;
use App\survey;
use App\Teacher;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.home');
    }
//Start Student mgm
    /**
     * function load page quản lý sinh viên
     */
    public function studentManagement() {
        $students = Student::all();
        return view('admin.student_management',compact('students'));
    }

    /**
     * function trả về thông tin sinh viên
     * @param id sv
     */
    public function infoStudent($id) {
        $student = Student::where('id','=',$id)->get()->toJson();
        return $student;
    }

    /**
     * xử lý form edit Student
     * @param thông tin sinh viên
     */
    public function studentEditSubmit(Request $request) {
        $student = Student::find($request->id);
        $student->ho_ten = $request->ho_ten;
        $student->username = $request->username;
        $student->email = $request->email;
        $student->lop_khoa_hoc = $request->lop_khoa_hoc;
        $student->save();
        return redirect("admin/home");
    }

    /**
     * xóa sinh viên
     * @param id sinh viên
     */
    public function deleteStudent(Request $request) {
        $student = Student::find($request->id);
        $student->delete();
        return redirect("admin/home");
    }

    public function studentSearch($sv_search) {
        $students = Student::search($sv_search)->get()->toJson();
        return $students;
    }

    /**
     * thêm 1 sv
     */
    public function studentAdd1(studentUpdateInfo $request) {
        //validate form
        $validated = $request->validated();
        //mã hóa mật khẩu
        $pass = bcrypt($request->password);
        DB::insert('insert into sinh_vien (username, password, ho_ten, email, lop_khoa_hoc) values (?, ?, ?, ?, ?)', [$request->username, $pass, $request->ho_ten, $request->email, $request->lop_khoa_hoc]);
        return redirect("admin/home");
    }
//End Student mgm


    /**
     * xóa lớp môn học
     * @param ma_mh
     */
    public function	deleteClass($ma_mh) {
        $rmClass = lop_mon_hoc::where('ma_mh','=',$ma_mh)->delete();
        $rmsubject = mon_hoc::where('ma_mh','=',$ma_mh)->delete();
    }
//Start survey item mgm
    /**
     * function load page quản lý phiếu khảo sát
     */
    public function survey_item_mgm() {
        $result = array();
        $categories = category_survey::all();
        foreach ($categories as $category) {
            $survey = $category->survey->toArray();
            array_push($result, [$category->ten_category => $survey]);
        }
        // return $result;
        return view('admin.survey_item_mgm',compact('result'));
    }

    public function infoSurveyCategory($ten_category) {
        $category = DB::table('category_khao_sat')->where('ten_category','=',$ten_category)->get()->toJson();
        return $category;
    }

    public function categoryEditSubmit(Request $request) {
        DB::table('category_khao_sat')->where('ma_category','=',$request->ma_category)->update(['ten_category'=>$request->ten_category]);
        return redirect('admin/home');
    }

    public function categoryDeleteSubmit(Request $request) {
        $category = category_survey::find($request->ma_category);
        $category->delete();
        return redirect("admin/home");
    }

    public function categoryAddSubmit(Request $request) {
        $category = new category_survey();
        $category->ten_category = $request->ten_category;
        $category->save();
        return redirect("admin/home");
    }

    public function infoSurveyItem($ma_phieu) {
        $item = DB::table('phieu_khao_sat')->where('ma_phieu','=',$ma_phieu)->get()->toJson();
        return $item;
    }
    
    public function itemEditSubmit(Request $request) {
        DB::table('phieu_khao_sat')->where('ma_phieu','=',$request->ma_phieu)->update(['ndung_phieu_ks'=>$request->ndung_phieu_ks]);
        return redirect('admin/home');
    }

    public function itemDeleteSubmit(Request $request) {
        $survey = Survey::find($request->ma_phieu);
        $survey->delete();
        return redirect("admin/home");
    }

    public function itemAddSubmit(Request $request) {
        $survey = new Survey();
        $survey->ma_category = $request->ma_category;
        $survey->ndung_phieu_ks = $request->ndung_phieu_ks;
        $survey->save();
        return redirect('admin/home');
    }
//End survey item mgm

    
//Start Teacher mgm
    /**
     * function load page quản lý giảng viên
     */
    public function teacher_mgm() {
        $teachers = Teacher::all();
        return view('admin.teacher_mgm',compact('teachers'));
    }

    /**
     * function trả về thông tin giảng viên
     * @param id giảng viên
     */
    public function infoTeacher($id) {
        $teacher = Teacher::where('id','=',$id)->get()->toJson();
        return $teacher;
    }

    /**
     * xử lý form edit Teacher
     * @param thông tin giảng viên
     */
    public function TeacherEditSubmit(Request $request) {
        $teacher = Teacher::find($request->id);
        $teacher->ho_ten = $request->ho_ten;
        $teacher->email = $request->email;
        $teacher->username = $request->username;
        $teacher->save();
        return redirect("admin/home");
    }

    /**
     * xóa giảng viên
     * @param username giảng viên
     */
    public function deleteTeacher(Request $request) {
        $teacher = Teacher::find($request->id);
        $teacher->delete();
        return redirect("admin/home");
    }

    public function teacherSearch($gv_search) {
        $teachers = Teacher::search($gv_search)->get()->toJson();
        return $teachers;
    }

    /**
     * thêm 1 gv
     */
    public function teacherAdd1(teacherUpdateInfo $request) {
        //validate form
        $validated = $request->validated();
        //mã hóa mật khẩu
        $pass = bcrypt($request->password);
        //insert
        $teacher = new Teacher();
        $teacher->ho_ten = $request->ho_ten;
        $teacher->email = $request->email;
        $teacher->username = $request->username;
        $teacher->save();
        return redirect("admin/home");
    }
//End teacher mgm
//Start survey reference mgm
    /**
     * function load page quản lý các cuộc khảo sát, lớp môn học
     */
    public function survey_ref_mgm() {
        $info = DB::select('SELECT ten_mh, gv, ma_mh, sv, count(*) as so_sv
                            FROM class
                            GROUP BY ma_mh');
        foreach ($info as $value) {
            $da_danh_gia = DB::select('SELECT count(*) as da_danh_gia FROM class WHERE ma_mh =\''.$value->ma_mh.'\' AND da_danh_gia = 1 GROUP BY ma_mh');
            $da_danh_gia = empty($da_danh_gia)?0:$da_danh_gia[0]->da_danh_gia;
            $value->da_danh_gia = $da_danh_gia;
            $chua_danh_gia = $value->so_sv - $value->da_danh_gia;
            $value->chua_danh_gia = $chua_danh_gia;
        }
        // return $result;
        return view('admin.survey_reference_mgm',compact('info'));
    }
    public function classSearch($class_search) {
        $info = DB::select('SELECT ten_mh, gv, ma_mh, sv, count(*) as so_sv
                                FROM class 
                                WHERE MATCH(ten_mh) AGAINST(?) 
                                    or MATCH(gv) AGAINST(?) 
                                    or MATCH(ma_mh) AGAINST(?) 
                                GROUP BY ma_mh', [$class_search,$class_search,$class_search]);
        foreach ($info as $value) {
            $da_danh_gia = DB::select('SELECT count(*) as da_danh_gia FROM class WHERE ma_mh =\''.$value->ma_mh.'\' AND da_danh_gia = 1 GROUP BY ma_mh');
            $da_danh_gia = empty($da_danh_gia)?0:$da_danh_gia[0]->da_danh_gia;
            $value->da_danh_gia = $da_danh_gia;
            $chua_danh_gia = $value->so_sv - $value->da_danh_gia;
            $value->chua_danh_gia = $chua_danh_gia;
        }
        return json_encode($info);
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
        return view('admin.ket_qua', compact(['result','lssv','mh_info','ten_gv']));
    }
//End survey reference mgm
}
