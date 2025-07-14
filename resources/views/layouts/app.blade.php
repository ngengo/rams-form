<!DOCTYPE html>
<html>

<head>
    <title>RAMS Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @yield('styles')
</head>

<body>
    <div class="header">
        <div class="header-left">
            <button id="logoButton" style="background: none; border: none; padding: 0;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="cursor: pointer; height: 60px;">
            </button>
            <button style="background: none; border: none; padding: 4px">
                <img src="{{ asset('images/aurora.png') }}" alt="Aurora" style="cursor: pointer; height: 60px;">
            </button>
        </div>
        <h1>OUTDOOR ACTIVITY RAMS FORM</h1>
        <div class="header-right">
            @yield('header-right')
        </div>
    </div>

    <div style="padding-top: 120px;">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoButton = document.getElementById('logoButton');
            const form = document.querySelector('form');
            let isDirty = false;

            if (form) {
                const fields = form.querySelectorAll('input, textarea, select');
                fields.forEach(field => {
                    field.addEventListener('input', () => {
                        isDirty = true;
                    });
                });
            }

            if (logoButton) {
                logoButton.addEventListener('click', function(e) {
                    if (form && isDirty) {
                        e.preventDefault();
                        if (confirm("You have unsaved changes. Do you want to discard and go to home?")) {
                            window.location.href = "{{ route('home') }}";
                        }
                    } else {
                        window.location.href = "{{ route('home') }}";
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>

<style>
    body {
        margin: 0;
        padding: 0;
        padding-bottom: 100px;
        font-family: 'Segoe UI', sans-serif;
        overflow-x: hidden;
        min-height: 100vh;
        position: relative;
        background-image: url('{{ asset('images/background5.jpg') }}');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        height: 60px;
        width: 100%;
        background: #f4f9fe;
        padding: 20px 40px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1000;
    }

    .header-left,
    .header-right {
        width: 200px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-left img {
        height: 60px;
    }

    .header-right:empty::before {
        content: '';
        display: block;
        width: 100px;
    }

    .header h1 {
        margin: 0 auto;
        font-size: 35px;
        font-weight: bold;
        text-align: center;
        color: #1f2c38;
        flex-grow: 1;
        padding-right: 50px;
    }

    .header-button {
        background-color: #1a4593;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
        font-size: 16px;
        color: #ffffff;
    }

    .header-button:hover {
        background-color: #0056b3;
    }
</style>