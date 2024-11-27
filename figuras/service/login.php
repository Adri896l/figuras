<?php
require '../config/base_datos.php'; 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

function enviarCodigoVerificacion($email, $usuario_id) {
    global $conn;

    $codigo = rand(100000, 999999);

    $expiracion = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    $query = "INSERT INTO codigos_verificacion (usuario_id, codigo, expiracion) VALUES (:usuario_id, :codigo, :expiracion)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':expiracion', $expiracion);
    $stmt->execute();

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'acc9908@gmail.com';    
        $mail->Password   = 'szuqfzkubiqqqwnc';               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('acc9908@gmail.com', 'Sistema de Verificación');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Código de verificación';
        $mail->Body    = "Tu código de verificación es: <b>$codigo</b>. Expira en 10 minutos.";

        $mail->send();
        echo 'El código ha sido enviado.';
    } catch (Exception $e) {
        echo "No se pudo enviar el correo: {$mail->ErrorInfo}";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['codigo'])) {
        $codigo_ingresado = $_POST['codigo'];
        $usuario_id = $_SESSION['usuario_id'];

        $query = "SELECT * FROM codigos_verificacion WHERE usuario_id = :usuario_id AND codigo = :codigo AND expiracion > NOW()";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':codigo', $codigo_ingresado);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Código verificado con éxito.";
            $query = "SELECT nombre FROM usuarios WHERE id = :usuario_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
        
            // Obtener el nombre del usuario y almacenarlo en la sesión
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['usuario'] = $usuario['nombre'];
        
            header("Location: ../public/index.php");
            exit();
        } else {
            echo "Código inválido o expirado.";
        }
    } else {
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            enviarCodigoVerificacion($email, $usuario['id']);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['nombre'];
            header("Location: ../public/verificacion.php"); 
            exit();
        } else {
            echo "Correo o contraseña incorrectos.";
        }
    }
}
?>
