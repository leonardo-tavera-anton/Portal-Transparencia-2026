<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal de Transparencia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --celeste: #00A8E8;
            --amarillo: #F5E727;
            --rojo: #F53527;
            --gris-oscuro: #2C3E50;
            --gris-claro: #ECF0F1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--celeste);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 400px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            background-color: white;
            border-radius: 10px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--amarillo);
            overflow: hidden;
            padding: 10px;
        }

        .logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo h1 {
            font-size: 22px;
            color: var(--gris-oscuro);
            margin-bottom: 5px;
        }

        .logo p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--gris-oscuro);
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--celeste);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: var(--celeste);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0087c1;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-img">
                <img src="{{ asset('/imagenes/logo.jpg') }}" alt="Logo MDNCH">
            </div>
            <h1>Portal de Transparencia</h1>
            <p>Municipalidad de Nuevo Chimbote</p>
        </div>

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
