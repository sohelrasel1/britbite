@extends('front.layout')

@section('meta-description', !empty($seo) ? $seo->login_meta_description : '')
@section('meta-keywords', !empty($seo) ? $seo->login_meta_keywords : '')

@section('pagename')
- {{__("Login")}}
@endsection
@section('breadcrumb-title')
{{__("Login")}}
@endsection
@section('breadcrumb-link')
{{__("Login")}}
@endsection

@section('content')

<div class="authentication-area ptb-120">
    <div class="container">
        <div class="main-form">
            <form id="#authForm" action="{{route('user.login')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h3>{{__('Login')}}</h3>
                </div>
                <div class="form-group mb-30">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email')}}" required>
                    @if(Session::has('err'))
                    <p class="text-danger mb-2 mt-2">{{Session::get('err')}}</p>
                    @endif
                    @error('email')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="form-group mb-30" style="position: relative;">
                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" required style="padding-right: 40px;">
                    <span id="togglePassword" class="toggle-password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa-regular fa-eye" id="passwordIcon"></i>
                    </span>
                    @error('password')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-30">
                    @if ($bs->is_recaptcha == 1)
                    <div class="d-block mb-4">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                        @php
                        $errmsg = $errors->first('g-recaptcha-response');
                        @endphp
                        <p class="text-danger mb-0 mt-2">{{__("$errmsg")}}</p>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="row align-items-center mb-2">
                    <div class="col-4 col-xs-12">
                        <div class="link">
                            <a href="{{route('user.forgot.password.form')}}">{{__('Lost your password')}}?</a>
                        </div>
                    </div>
                    <div class="col-8 col-xs-12">
                        <div class="link go-signup">
                            {{__("Don't have an account?")}} <a href="{{route('front.pricing')}}">{{__("Click Here")}}</a> {{__("to Signup")}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn primary-btn w-100"> {{__('LOG IN')}} </button>
            </form>
        </div>
    </div>
</div>




<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the input type
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the icon
        if (type === 'password') {
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        } else {
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        }
    });
</script>

<style>
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 16px;
    }

    .toggle-password-icon i {
        font-size: 18px;
        color: #6c757d;
    }

    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }
</style>

@endsection