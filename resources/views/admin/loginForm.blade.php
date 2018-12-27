<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" type="text/css" href="{{('css/LoginForm.css')}}">
</head>
<body>
    <div class="loginbox">
        <img src="{{asset('images/usericon.png')}}" class="avatar">
        <h1>Login Here</h1>
        <form action="{{ route('admin.postLogin') }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <ul>
                    @if(session()->has('error'))
                        <li class = "error">{{ session()->get( 'error' ) }}</li>
                    @endif
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            <li class = "error">{!! $error !!}</li>
                        @endforeach
                    @endif
            </ul>
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <input type="submit" name="" value="Login"><br>
        </form>
    </div>
</body>
</html>