<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }
        .login-container h3 {
            margin-bottom: 20px;
        }
        .form-group {
            text-align: left;
        }
        .form-group label {
            font-weight: bold;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #006F91;
            text-decoration: underline;
        }
        .register-link {
            margin-top: 15px;
        }
        .register-link a {
            color: #006F91;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="/assets/img/logobbpsip.png" alt="Logo">
    <h3>Login</h3>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <form action="{{ route('login.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
            <div class="forgot-password">
                <a href="/forgot-password">Lupa password?</a>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <div class="register-link">
        <p>Belum punya akun? <a href="/register" style="text-decoration: none;">Daftar sekarang!</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>