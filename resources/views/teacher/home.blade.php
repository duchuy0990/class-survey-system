@extends('layouts.app')

@section('guard')
    <a class="navbar-brand" href="{{ route('teacher.home') }}">TEACHER</a>
@stop

@section('username'){{ Auth::user()->ho_ten }}@endsection

@section('link_logout'){{url('teacher/logout')}}@endsection

@section('content')
<div class="card-column tc-list-class">
    @foreach ($classes as $class)
        <div class="card border-dark mb-3">
            @if ($class->total_sv == $class->da_danh_gia)
                <div class="card-header survey-stt">
                    <small class="text-muted survey-done"></small>
                    <a href="" target="_blank" class="btn btn-success" style="margin-top:0">Xem kết quả</a>
                </div>
            @else
                <div class="card-header survey-stt">
                    <small class="text-muted survey-fault"></small>
                </div>
            @endif
            <div class="card-body text-dark">
                <h5 class="card-title">Môn học: {{$class->ten_mh}}</h5>
                <p class="card-text">Mã: {{$class->ma_mh}}</p>
                <p class="card-text" id="name-GV">Giảng viên: {{$class->ho_ten}}</p>
                <p class="card-text" >Đã đánh giá: {{$class->da_danh_gia}}/{{$class->total_sv}}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection


