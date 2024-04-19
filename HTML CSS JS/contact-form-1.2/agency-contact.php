<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["tel"])  || !isset($_POST["asunto"])  || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}

$nombre = $_POST["nombre"];

$email = $_POST["email"];

$telefono = $_POST["tel"];

$asunto = $_POST["asunto"];

$mensaje = $_POST["mensaje"];


// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c2521761.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@saymac.com.ar";  // Mi cuenta de correo
$smtpClave = "Piramide2023@";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "info@saymac.com.ar";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Formulario desde el sitio web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html>

<body>

<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$nombre}</p>

<p>email: {$email}</p>

<p>telefono: {$tel}</p>

<p>asunto: {$asunto}</p>

<p>mensaje: {$mensaje}</p>

</body>

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo By DonWeb"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

// prueba
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//prueba fin //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "<script>alert ('El correo fue enviado correctamente')</script>";
    
} else {
    echo "<script>alert ('El correo fue enviado correctamente')</script>";
    echo "<script> setTimeout(\"location.href='index.html'\",1000)</script>;
}