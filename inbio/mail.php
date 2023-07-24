<?php
$name = trim($_POST['contact-name']);
$phone = trim($_POST['contact-phone']);
$email = trim($_POST['contact-email']);
$message = trim($_POST['contact-message']);
if ($name == "") {
    $msg['err'] = "\n ¡El nombre no puede estar vacío!";
    $msg['field'] = "contact-name";
    $msg['code'] = FALSE;
} else if ($phone == "") {
    $msg['err'] = "\n ¡El número de teléfono no puede estar vacío!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if (!preg_match("/^[0-9 \\-\\+]{4,17}$/i", trim($phone))) {
    $msg['err'] = "\n Por favor, ponga un número de teléfono válido!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if ($email == "") {
    $msg['err'] = "\n ¡El correo electrónico no puede estar vacío!";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['err'] = "\n Por favor, introduzca una dirección de correo electrónico válida.";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if ($message == "") {
    $msg['err'] = "\n ¡El mensaje no puede estar vacío!";
    $msg['field'] = "contact-message";
    $msg['code'] = FALSE;
} else {
    $to = 'guerre.pablo.agustin@gmail.com';
    $subject = 'Consulta de contacto de';
    $_message = '<html><head></head><body>';
    $_message .= '<p>Name: ' . $name . '</p>';
    $_message .= '<p>Message: ' . $phone . '</p>';
    $_message .= '<p>Email: ' . $email . '</p>';
    $_message .= '<p>Message: ' . $message . '</p>';
    $_message .= '</body></html>';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:  Papr <guerre.pablo.agustin@gmail.com>' . "\r\n";
    $headers .= 'cc: guerre.pablo.agustin@gmail.com' . "\r\n";
    $headers .= 'bcc: guerre.pablo.agustin@gmail.com' . "\r\n";
    mail($to, $subject, $_message, $headers, '-f guerre.pablo.agustin@gmail.com');

    $msg['success'] = "\n El correo electrónico ha sido enviado con éxito.";
    $msg['code'] = TRUE;
}
echo json_encode($msg);