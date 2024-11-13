@extends('front.layout')

@section('pagename')
- {{$package->title}}
@endsection

@section('meta-description', !empty($package) ? $package->meta_keywords : '')
@section('meta-keywords', !empty($package) ? $package->meta_description : '')

@section('breadcrumb-title')
{{$package->title}}
@endsection
@section('breadcrumb-link')
{{$package->title}}
@endsection

@section('content')

<div class="authentication-area pt-90 pb-120">
    <div class="container">
        <div class="main-form">
            <form id="#authForm" action="{{ route('front.checkout.view') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h3>{{ __('Signup') }}</h3>
                </div>
                <div class="form-group mb-30">
                    <input type="text" class="form-control" name="username" placeholder="{{ __('Username') }}"
                        value="{{ old('username') }}" required>
                    @if ($hasSubdomain)
                    <p class="mb-0">
                        {{ __('Your subdomain based website URL will be') }}:
                        <strong class="text-primary"><span
                                id="username">{username}</span>.{{env('WEBSITE_HOST')}}</strong>
                    </p>
                    @endif
                    <p class="text-danger mb-0" id="usernameAvailable"></p>
                    @error('username')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-30">
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                        placeholder="{{  __('Email Address') }}">
                    @error('email')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!-- <div class="form-group mb-30">
                        <input class="form-control" type="password" name="password" value="{{ old('password') }}"
                               placeholder="{{ __('Password') }}" >
                        @error('password')
                        <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-30">
                        <input class="form-control" id="password-confirm" type="password"
                               placeholder="{{ __('Confirm Password') }}" name="password_confirmation" 
                               autocomplete="new-password">
                        @error('password')
                        <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                        @enderror
                    </div> -->

                <div class="form-group mb-30" style="position: relative;">
                    <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}"
                        placeholder="{{ __('Password') }}" style="padding-right: 40px;">
                    <span id="togglePassword" class="toggle-password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa-regular fa-eye" id="passwordIcon"></i>
                    </span>
                    @error('password')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mb-30" style="position: relative;">
                    <input class="form-control" id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                        name="password_confirmation" autocomplete="new-password" style="padding-right: 40px;">
                    <span id="togglePasswordConfirm" class="toggle-password-icon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        <i class="fa-regular fa-eye" id="passwordConfirmIcon"></i>
                    </span>
                    @error('password_confirmation')
                    <p class="text-danger mb-2 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="hidden" name="id" value="{{ $id }}">
                </div>
                <button type="submit" class="btn primary-btn w-100"> {{ __('Continue') }} </button>
            </form>
        </div>
    </div>
</div>


<script>
    // Password field toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        passwordIcon.classList.toggle('fa-eye');
        passwordIcon.classList.toggle('fa-eye-slash');
    });

    // Confirm password field toggle
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const confirmPasswordField = document.getElementById('password-confirm');
    const passwordConfirmIcon = document.getElementById('passwordConfirmIcon');

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        passwordConfirmIcon.classList.toggle('fa-eye');
        passwordConfirmIcon.classList.toggle('fa-eye-slash');
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

@section('scripts')

<script>
    let hasSubdomain = "{{ $hasSubdomain }}";
</script>
<script src="{{ asset('assets/front/js/custom.js') }}"></script>
@endsection