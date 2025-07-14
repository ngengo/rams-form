@extends('layouts.app')

@section('header-right')
    <button class="header-button"onclick="window.location.href='{{ route('form.login-admin') }}'">Admin</button>
@endsection

@section('content')
    <div class="main">
        <p>Plan your next outdoor activity safely.<br>Complete the RAMS form.</p>

        <div class="plus-icon" onclick="window.location.href='{{ route('form.create') }}'">
            <h1>+</h1>
        </div>

        <div class="fill-text">Fill a New Form</div>

        <button class="secondary-btn" onclick="window.location.href='{{ route('guideline') }}'">
            How to use UAP form
        </button>
    </div>
@endsection

<style>
    body {
        background-color: #eeeeee;
        font-family: 'Segoe UI', sans-serif;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 70px;
        font-weight: normal;
        color: #2c3e50;
        margin-top: 30px;
    }

    .header-button {
        background-color: #f0f0f0;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
    }

    .main {
        max-width: 450px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 20px;
        border: 4px solid #c4c4c4;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
        text-align: center;
        color: black;
    }

    .main p {
        margin-top: 10px;
        color: #555;
        font-size: 16px;
    }

    .plus-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 6px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px auto;
        font-size: 50px;
        color: #2c3e50;
        cursor: pointer;
        background-color: white;
        transition: 0.3s;
    }

    .plus-icon:hover {
        background-color: #f9f9f9;
    }

    .fill-text {
        font-size: 18px;
        color: #2c3e50;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .secondary-btn {
        padding: 8px 20px;
        border: 2px solid #ccc;
        border-radius: 20px;
        background-color: white;
        color: #2c3e50;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
    }

    .secondary-btn:hover {
        background-color: #f9f9f9;
    }
</style>