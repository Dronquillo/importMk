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
    $subject = sanitizeInput($_POST['subject']);
    $message = sanitizeInput($_POST['message']);

    // Validar correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }

    // Construir correo
    $to = "facturacion.ayacucho@importadoramundokorea.com";
    $fullSubject = "Contacto: " . $subject;
    $fullMessage = "Correo: " . $email . "\n\n";
    $fullMessage .= "Mensaje:\n" . $message;

    $headers = "From: noreply@importadoramundokorea.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Enviar correo
    if (mail($to, $fullSubject, $fullMessage, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
}
?>

