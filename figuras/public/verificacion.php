<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código</title>
    <link rel="stylesheet" href="assets/css/veri.css"> 
</head>
<body>
    <div class="login-container">
        <h1>Verificación de Código</h1>
        <form action="../service/login.php" method="post"> 
            <div class="form-group">
                <label for="codigo">Código de verificación:</label>
                <input type="text" id="codigo" name="codigo" required class="form-control" placeholder="Ingresa el código">
            </div>
            <button type="submit" class="btn btn-primary">Verificar</button>
        </form>
    </div>
</body>
</html>
