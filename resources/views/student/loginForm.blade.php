@extends('layouts.intro')
@section('login')
<div class="col-sm-4 loginbox">
    <h1>Sinh viên</h1>
    @php
        $linkSubmitForm = route('student.postLogin');
    @endphp
    @include('layouts.loginForm',['linkSubmitForm'=> $linkSubmitForm ])
</div>
@endsection