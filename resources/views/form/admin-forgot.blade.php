@extends('layouts.app')

@section('header-right')
    <button class="header-button" onclick="window.location.href='{{ route('form.login-admin') }}'">Back</button>
@endsection

@section('content')
<div class="forgot-container">
    <div class="forgot-box">
        <h2><i class="fas fa-unlock-alt"></i> Forgot Password</h2>
        <p>Enter your email to reset your password</p><br>

        @if (session('status'))
            <div class="success-msg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

        <div class="form-group">
            <i class="fas fa-envelope icon"></i>
            <input id="email" name="email" type="email" placeholder="Your email here" required>
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror    
        </div>

        <br><button type="submit" class="login-button">Send Reset Link</button>
        </form>
    </div>
</div>
@endsection

<style>
.forgot-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 75vh;
}

.forgot-box {
    background: #fff;
    padding: 45px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 14px;
}

.form-group i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

.form-group .icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
    font-size: 16px;
}

.login-button {
    background-color: #198754;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.login-button:hover {
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
</style>

