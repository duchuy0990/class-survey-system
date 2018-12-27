@extends('layouts.app')
@section('guard')
    <a class="navbar-brand" href="{{ route('student.home') }}">STUDENT</a>
@stop
@section('username'){{ Auth::user()->ho_ten }}@endsection
@section('link_logout'){{url('student/logout')}}@endsection
@section('content')
    @if (session()->has('success'))
    {{session()->get('success')}}
    <button>Quay lại trang chủ</button>
    @php
    session()->forget('success');
    @endphp
    <script>
        $(document).ready(function () {
            setTimeout(function (){
                window.location.href = "{{url('student/home')}}";
              }, 3000);
        });
    </script>
    @endif
@endsection

