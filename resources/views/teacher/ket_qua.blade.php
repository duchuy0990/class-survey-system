@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/viewClass.css')}}">
@endsection

@section('guard')
    <a class="navbar-brand" href="{{ route('teacher.home') }}">TEACHER</a>
@stop

@section('link_logout'){{url('teacher/logout')}}@endsection

@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kết quả đánh giá</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Danh sách sinh viên</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="margin-top:20px">
            <div style="margin-left:15px;">
                <span>Môn học: {{$mh_info[0]->ten_mh}}</span><br>
                <span>Mã môn học: {{$mh_info[0]->ma_mh}}</span><br>
                <span>Giảng viên: {{$ten_gv[0]->ten_gv}}</span><br>
            </div>
            <div class="table-responsive table-result">
                <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tiêu chí</th>
                                <th>Điểm TB</th>
                                <th>Trên 5</th>
                                <th>Dưới 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($result as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="criteria">{{$item->ndung_phieu_ks}}</td>
                                    <td class="medium-score">{{$item->dtb}}</td>
                                    <td class="up-5">{{$item->greater_5}}%</td>
                                    <td class="under-5">{{100-$item->greater_5}}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>

            <div class="note-result">
                <div class="row">
                    <div class="col note-item">
                        <label>Điểm TB: </label>
                        <p>Tổng điểm sinh viên đánh giá cho tiêu chí / số sinh viên</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col note-item">
                        <label>Trên 5: </label>
                        <p>Tỉ lệ sinh viên đánh giá trên 5 điểm</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col note-item">
                        <label>Dưới 5: </label>
                        <p>Tỉ lệ sinh viên đánh giá dưới 5 điểm</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col justify-content-end">
                        <!-- icon export -->.
                        <div class="export-excel">
                            <a href="{{url('teacher/export/'.$mh_info[0]->ma_mh)}}" target="_blank"><img class="icon-export" src="{{asset('images/icon-export-excel.png')}}"></a>
                            <div class="overflay overFlayLeft">
                                <label>Xuất excel !</label>
                            </div>
                            <div class="arrow-right"></div>
                        </div>
                        <!-- end -->
                    </div>
                </div>
                
            </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div id="data-tk-sv" name="tk-sv">
                <div class="table-responsive admin-status">
                    <table class="table table-hover">
                        <thead class="table-active">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Mã sinh viên</th>
                            <th scope="col">Lớp khóa học</th>
                            <th scope="col">Email</th>
                            <th scope="col">Đã đánh giá</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $j=1;
                            @endphp
                            @foreach ($lssv as $student)
                                <tr>
                                        <th scope="row">{{$j++}}</th>
                                        <td class="name-st">{{$student->sv_name}}</td>
                                        <td class="id-st">{{$student->sv_msv}}</td>
                                        <td class="class-st">{{$student->sv_lop}}</td>
                                        <td class="email-st">{{$student->sv_email}}</td>
                                        <td class="da_danh_gia">@if ($student->da_danh_gia === 0)
                                                                    <i class="fas fa-times" style="color:red"></i>
                                                                @else
                                                                    <i class="fas fa-check" style="color:green"></i>
                                                                @endif
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection