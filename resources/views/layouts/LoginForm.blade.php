<form method="POST" action="{{$linkSubmitForm}}">
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
    <p>Tài khoản</p>
    <input type="text" name="username" id="username" placeholder="Enter Username">
    <p>Mật khẩu</p>
    <input type="password" name="password" id="password" placeholder="Enter Password">
    <input type="submit" name="" value="Login"><br>
</form>