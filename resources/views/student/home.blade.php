@extends('layouts.app')
@if (session()->has('success'))
    alert({{session()->get('success')}});
    session()->forget('success');
    session()->flush();
@endif
@section('guard')
    <a class="navbar-brand" href="{{ route('student.home') }}">STUDENT</a>
@stop

@section('username'){{ Auth::user()->ho_ten }}@endsection

@section('link_logout'){{url('student/logout')}}@endsection

@section('content')
    <div class="card-columns sv-list-class">
        @foreach ($classes as $class)
            <div class="card border-dark mb-3">
                @if ($class->da_danh_gia==0)
                    <div class="card-header survey-stt">
                        <small class="text-muted survey-fault"></small>
                        <a href="{{url('student/danh_gia/'.$class->ma_mh)}}" target="_blank" class="btn btn-primary" style="margin-top:0">Đánh giá</a>
                    </div>
                @else
                    <div class="card-header survey-stt">
                        <small class="text-muted survey-done"></small>
                        <a href="{{url('student/danh_gia/'.$class->ma_mh)}}" target="_blank" class="btn btn-success" style="margin-top:0">Đánh giá lại</a>
                    </div>
                @endif
                <div class="card-body text-dark">
                    <h5 class="card-title">Môn học: {{$class->ten_mh}}</h5>
                    <p class="card-text">Mã: {{$class->ma_mh}}</p>
                    <p class="card-text" id="name-GV">Giảng viên: {{$class->ho_ten}}</p>
                </div>
            </div>
        @endforeach
    </div>
@stop


