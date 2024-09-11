<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <title>{{$bs->website_title}}</title>
    <link rel="icon" href="{{asset('assets/front/img/'.$bs->favicon)}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<!-- <div class="login-page">
    <div class="text-center mb-4">
        <img class="login-logo" src="{{asset('assets/front/img/'.$bs->logo)}}" alt="">
    </div>
    <div class="form">
        @if (session()->has('alert'))
            <div class="alert alert-danger fade show" role="alert">
                <strong>{{__('Oops')}}!</strong> {{session('alert')}}
            </div>
        @endif
        <form class="login-form" action="{{route('admin.login.submit')}}" method="POST">
            @csrf
            <input type="text" name="username" value="{{ old('username') }}" placeholder="{{__('username')}}"/>
            @if ($errors->has('username'))
                <p class="text-danger text-left">{{$errors->first('username')}}</p>
            @endif
            <input type="password" name="password" value="{{ old('password') }}" placeholder="{{__('password')}}"/>
            @if ($errors->has('password'))
                <p class="text-danger text-left">{{$errors->first('password')}}</p>
            @endif
            <button type="submit">{{__('login')}}</button>
        </form>
        <a class="forget-link" href="{{route('admin.forget.form')}}">{{__('Forgot Password')}} ?</a>
    </div>
</div> -->


<div class="login-page">
    <div class="text-center mb-4">
        <img class="login-logo" src="{{asset('assets/front/img/'.$bs->logo)}}" alt="">
    </div>
    <div class="form">
        @if (session()->has('alert'))
            <div class="alert alert-danger fade show" role="alert">
                <strong>{{__('Oops')}}!</strong> {{session('alert')}}
            </div>
        @endif
        <form class="login-form" action="{{route('admin.login.submit')}}" method="POST">
            @csrf
            <input type="text" name="username" value="{{ old('username') }}" placeholder="{{__('username')}}"/>
            @if ($errors->has('username'))
                <p class="text-danger text-left">{{$errors->first('username')}}</p>
            @endif
            <div class="password-wrapper">
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="{{__('password')}}"/>
                <span id="togglePassword" class="toggle-password-icon">
                <i class="fa-regular fa-eye"></i>
                </span>
            </div>
            @if ($errors->has('password'))
                <p class="text-danger text-left">{{$errors->first('password')}}</p>
            @endif
            <button type="submit">{{__('login')}}</button>
        </form>
        <a class="forget-link" href="{{route('admin.forget.form')}}">{{__('Forgot Password')}} ?</a>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<style>
    .password-wrapper {
        position: relative;
    }

    .toggle-password-icon {
        position: absolute;
        top: 42%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .toggle-password-icon i {
        font-size: 1.2em;
        color: gray;
    }
</style>



<script src="{{asset('assets/admin/js/core/jquery.min.js')}}"></script>

<script src="{{asset('assets/admin/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/core/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

</body>
</html>
