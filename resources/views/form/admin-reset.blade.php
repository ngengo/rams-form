@extends('layouts.app')

@section('header-right')
    <button class="header-button" onclick="window.location.href='{{ route('form.login-admin') }}'">Back</button>
@endsection

@section('content')
<div class="reset-container">
    <div class="reset-box">
        <h2><i class="fas fa-key"></i> Reset Password</h2>
        <p>Enter new password to reset your old password</p><br>

        @if (session('status'))
            <div class="success-msg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group">
            <div class="input-wrapper">
                <i class="fas fa-lock icon"></i>
                <input id="password" name="password" type="password" placeholder="Your password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggleIconPassword"></i>
                </button>
            </div>
            @error('password')
                <div class="error-msg">{{ $message }}</div>
             @enderror
        </div>

        <div class="form-group">
            <div class="input-wrapper">
                <i class="fas fa-lock icon"></i>
                <input id="password-confirmation" name="password_confirmation" type="password" placeholder="Confirm your password" required>
                <button type="button" class="toggle-password" onclick="togglePasswordConfirmation()">
                    <i class="fas fa-eye" id="toggleIconPasswordConfirmation"></i>
                </button>
            </div>
            @error('password_confirmation')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

            <br><button type="submit" class="reset-button">Reset Password</button>
        </form>
    </div>
</div>

<style>
    .reset-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 75vh;
    }

    .reset-box {
        background: #fff;
        padding: 45px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 350px;
        text-align: center;
    }

    .reset-box h2 {
        font-size: 22px;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
    margin-bottom: 25px;
}


    .input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 14px;
    box-sizing: border-box;
}

.icon {
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
}

    .toggle-password:hover {
        background: transparent;
        color: #888;
        box-shadow: none;
    }

    .reset-button {
        background-color: #198754;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .reset-button:hover {
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
    margin-top: 6px;
    text-align: left;
    padding-left: 5px;
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