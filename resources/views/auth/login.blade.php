
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Access Control | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{

            background:#f4f6f9;

            height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;

        }

        .login-card{

            width:380px;

            border:none;

            border-radius:18px;

            box-shadow:0 10px 30px rgba(0,0,0,.10);

        }

        .logo{

            width:70px;

            height:70px;

            background:#0d6efd;

            color:#fff;

            border-radius:50%;

            display:flex;

            align-items:center;

            justify-content:center;

            margin:auto;

            font-size:30px;

        }

        .form-control{

            height:46px;

            border-radius:10px;

        }

        .btn-login{

            height:46px;

            border-radius:10px;

            font-weight:600;

        }

        .footer{

            text-align:center;

            font-size:13px;

            color:#6c757d;

            margin-top:20px;

        }

    </style>

</head>

<body>

<div class="card login-card">

    <div class="card-body p-4">

        <div class="text-center mb-4">

            <div class="logo">

                <i class="bi bi-shield-lock-fill"></i>

            </div>

            <h4 class="mt-3 mb-1">

                Smart Access Control

            </h4>

            <small class="text-muted">

                Admin Login

            </small>

        </div>

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <form method="POST" action="/login">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Password

                </label>

                <div class="input-group">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required>

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword()">

                        <i class="bi bi-eye" id="eyeIcon"></i>

                    </button>

                </div>

            </div>

            <div class="form-check mb-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="remember">

                <label
                    class="form-check-label"
                    for="remember">

                    Remember Me

                </label>

            </div>

            <button
                class="btn btn-primary w-100 btn-login">

                <i class="bi bi-box-arrow-in-right"></i>

                Login

            </button>

        </form>

        <div class="footer">

            © 2026 Smart Access Control System

        </div>

    </div>

</div>

<script>

function togglePassword(){

    let password=document.getElementById("password");

    let icon=document.getElementById("eyeIcon");

    if(password.type==="password"){

        password.type="text";

        icon.classList.remove("bi-eye");

        icon.classList.add("bi-eye-slash");

    }else{

        password.type="password";

        icon.classList.remove("bi-eye-slash");

        icon.classList.add("bi-eye");

    }

}

</script>

</body>
</html>
