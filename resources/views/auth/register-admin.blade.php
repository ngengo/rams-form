@extends('layouts.app')

@section('header-right')
    <button class="header-button" onclick="window.location.href='{{ url()->previous() ?? route('login-admin') }}'">Login</button>
@endsection

@section('content')
<div class="register-container">
    <div class="register-box">
        <h2>Admin Registration</h2><br>

        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('form.register-admin') }}">
            @csrf

            <div class="form-group">
                <i class="fas fa-user icon"></i>
                <input id="name" name="name" type="text" placeholder="Your full name here" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <i class="fas fa-envelope icon"></i>
                <input id="email" name="email" type="email" placeholder="Your email here" required>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <i class="fas fa-lock icon"></i>
                <input id="password" name="password" type="password" placeholder="Your password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye" id="toggleIconPassword"></i>
                </button>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <i class="fas fa-lock icon"></i>
                <input id="password-confirmation" name="password-confirmation" type="password" placeholder="Confirm your password" required>
                <button type="button" class="toggle-password" onclick="togglePasswordConfirmation()">
                    <i class="fas fa-eye" id="toggleIconPasswordConfirmation"></i>
                </button>
                @error('password-confirmation')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="register-button">Register</button>

             <div class="divider"></div>

            <div class="link-group">
                <a href="{{ route('form.login-admin') }}">Already have an account?</a>
            </div>
        </form>
    </div>
</div>

<style>
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 85vh;
    }

    .register-box {
        background: #fff;
        padding: 60px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 350px;
        text-align: center;
    }

    .register-box h2 {
       font-size: 22px;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 12px 40px 12px 40px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 14px;
    }

    .form-group .icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 16px;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #888;
        cursor: pointer;
        font-size: 16px;
    }

    .toggle-password:hover {
        background: transparent;
        color: #888;
        box-shadow: none;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin: -10px 0 15px;
        font-size: 14px;
        color: #333;
    }

    .register-button {
        width: 100%;
        padding: 12px;
        background-color: #198754;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 25px;
        font-weight: bold;
        margin-top: 10px;
    }

    .register-button:hover {
        background-color: #157347;
    }

    .success-msg {
        color: green;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .error-msg {
        color: red;
        font-size: 13px;
        margin-top: 5px;
        text-align: left;
    }

    .divider {
        height: 1px;
        background: #ccc;
        margin: 20px 0 10px;
    }

    .link-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .link-group a {
        font-size: 14px;
        color: #6c2eb9;
        text-decoration: none;
    }

    .link-group a:hover {
        text-decoration: underline;
    }
</style>

<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIconPassword");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

function togglePasswordConfirmation() {
    const passwordConfirmationField = document.getElementById("password-confirmation");
    const toggleIcon = document.getElementById("toggleIconPasswordConfirmation");

    if (passwordConfirmationField.type === "password") {
        passwordConfirmationField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordConfirmationField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}
</script>
@endsection