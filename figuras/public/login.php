<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="login-form" id="loginForm">
            <h1>Iniciar Sesión</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class='bx bxl-google-plus' id="google-signin"></i></a>
                <a href="#" class="icon"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="icon"><i class='bx bxl-github'></i></a>
                <a href="#" class="icon"><i class='bx bxl-linkedin'></i></a>
            </div>

            <div class="form-message-container">
                <span>O utiliza tu correo electrónico y contraseña</span>
            </div>

            <form id="loginForm" action="../service/login.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="contrasena" placeholder="Password" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="#" id="showSignup">Regístrate</a></p>
        </div>

        <div class="signup-form hidden" id="signupForm">
            <h1>Crear Cuenta</h1>
            <div class="social-icons">
            
                <a href="#" class="icon"><i class='bx bxl-google-plus'></i></a>
                <a href="#" class="icon"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="icon"><i class='bx bxl-github'></i></a>
                <a href="#" class="icon"><i class='bx bxl-linkedin'></i></a>
            </div>
            <div class="form-message-container">
                <span>O utiliza tu correo electrónico para registrarte</span>
            </div>

            <form id="signupForm" action="../service/registro.php" method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="contrasena" placeholder="Password" required>
                <button type="submit">Registrar</button>
            </form>
            <p>¿Ya tienes una cuenta? <a href="#" id="showLogin">Iniciar Sesión</a></p>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>

</html>