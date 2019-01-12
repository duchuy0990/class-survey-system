<?php

namespace App\Http\Controllers;

use App\Imports\StudentsClassImport;
use App\Imports\TeachersImport;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
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
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function studentimport(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file;
            Excel::import(new StudentsImport,$file);
            return "thành công!";
        }
        else return "k nhận được tệp đính kèm";
    }
    public function teacherimport(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file;
            Excel::import(new TeachersImport,$file);
            return "thành công!";
        }
        else return "k nhận được tệp đính kèm";
    }
    public function studentclassimport(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file;
            Excel::import(new StudentsClassImport,$file);
            return "thành công!";
        }
        else return "k nhận được tệp đính kèm";
    }
}