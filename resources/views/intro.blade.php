@extends('layouts.intro')
@section('login')
<div class="session-login shadow p-3 bg-white rounded">
    <div class="title-session">
        Đăng nhập với
        <img src="images/next-icon.png">
    </div>
    <div class="btn-session">
        <button type="button" class="btn btn-info" id="btn-login-st"><a href="{{route('student.getLogin')}}">Sinh viên</a></button>
        <br>
        <button type="button" class="btn btn-info" id="btn-login-tc"><a href="{{route('teacher.getLogin')}}">Giảng viên</a></button>
    </div>    
</div>
@endsection