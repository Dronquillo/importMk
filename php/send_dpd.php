<?php
session_start();

// Función para sanitizar entradas
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Verificar método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token inválido.");
    }

    // Sanitizar entradas
    $email   = sanitizeInput($_POST['email']);
    $message = sanitizeInput($_POST['message']);

    // Validar correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }

    // Construir correo
    $to = "dpd.partkorea@importadoramundokorea.com";
    $subject = "Denuncia/Comentario - Protección de Datos";
    $fullMessage = "Correo: " . $email . "\n\n";
    $fullMessage .= "Comentario:\n" . $message;

    $headers = "From: noreply@importadoramundokorea.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Enviar correo
    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
}
?>

