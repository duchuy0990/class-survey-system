@extends('layouts.intro')
@section('login')
<div class="col-sm-4 loginbox">
    <h1>Giảng viên</h1>
    @php
        $linkSubmitForm = route('teacher.postLogin');
    @endphp
    @include('layouts.loginForm',['linkSubmitForm'=> $linkSubmitForm ])
</div>
@endsection