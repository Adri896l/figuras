<?php
require '../config/base_datos.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); 

    $query = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "El correo ya está registrado.";
    } else {
        $query = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);

        if ($stmt->execute()) {
            $usuario_id = $conn->lastInsertId();
            enviarCodigoVerificacion($email, $usuario_id);
            echo "Se ha enviado un código de verificación a tu correo. Verifícalo para continuar.";
        } else {
            echo "Error al crear la cuenta.";
        }
    }
}

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
?>
