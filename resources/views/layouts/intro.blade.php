@extends('layouts.app')

@section('guard')
    <a class="navbar-brand" href="{{ url('/') }}">CLASS SURVEY SYSTEM</a>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/introduce.css')}}">
@endsection

@section('content')
<div class="container ctn">
    <div class="row">
        <div class="col-sm-6">
            <div id="carouselExampleIndicators " class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                  </ol>
                  <div class="carousel-inner slideshow">
                      <div class="carousel-item active">
                          <img class="d-block w-100" src="{{asset('images/slideshow0.jpg')}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                          <img class="d-block w-100" src="{{asset('images/slideshow1.jpg')}}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                          <img class="d-block w-100" src="{{asset('images/slideshow2.jpg')}}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                          <img class="d-block w-100" src="{{asset('images/slideshow3.jpg')}}" alt="Four slide">
                    </div>
                    <div class="carousel-item">
                          <img class="d-block w-100" src="{{asset('images/slideshow4.jpg')}}" alt="Five slide">
                    </div>
                  </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-4 login">
            @yield('login')
        </div>
    </div>
    <div class="row text-intro shadow-lg p-3 rounded">
        <div class="col-sm-5">
            <label><h3><a href="{{route('teacher.getLogin')}}">Giảng viên</a></h3></label>
            <p>
                - Xem đánh giá của sinh viên về môn học. <br>
                - Xem đánh giá của sinh viên về phương pháp dạy học. <br>
                - Nắm rõ tâm tư sinh viên. <br>
                - Nâng cao chât lượng giảng dạy. <br>
                - Tổng quan về tình hình giảng dạy trong kỳ học.
            </p>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <label><h3><a href="{{route('student.getLogin')}}">Sinh viên</a></h3></label>
            <p>
                - Đánh giá phương pháp giảng dạy của giảng viên. <br>
                - Đánh giá chất lượng cơ sở vật chất. <br>
                - Đánh giá chất lượng môn học. <br>
                - Tăng tương tác giữa nhà trường và sinh viên.
            </p>
        </div>
    </div>
</div>
@endsection