<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if (!isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["asunto"]) || !isset($_POST["mensaje"])) {
    die("Es necesario completar todos los datos del formulario");
}

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c2541681.ferozo.com";  // Dominio alternativo brindado en el email de alta     
$smtpUsuario = "info@estudiojuridicorz.com";  // Mi cuenta de correo
$smtpClave = "Shambala1126@";  // Mi contraseña

// Email donde se enviarán los datos cargados en el formulario de contacto
$emailDestino = "info@estudiojuridicorz.com";

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

$mail->Subject = "Formulario desde el sitio web"; // Este es el título del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html>
<body>
    <h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>
    <table width='50%' border='0' align='center' cellpadding='0' cellspacing='0'>
        <tr>
            <td colspan='2' align='center' valign='top'><img style=' margin-top: 15px; ' src='http://www.estudiojuridicorz.com/images/logo-agency-footer.png' ></td>
        </tr>
        <tr>
            <td width='50%' align='right'>&nbsp;</td>
            <td align='left'>&nbsp;</td>
        </tr>
        <tr>
            <td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nombre:</td>
            <td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>{$nombre}</td>
        </tr>
        <tr>
            <td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Email:</td>
            <td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>{$email}</td>
        </tr>
        <tr>
            <td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Asunto:</td>
            <td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>{$asunto}</td>
        </tr>
        <tr>
            <td align='right' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Mensaje:</td>
            <td align='left' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>{$mensaje}</td>
        </tr>
    </table>
</body>
</html>
<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de ejemplo By DonWeb"; // Texto sin formato HTML

$estadoEnvio = $mail->Send();

if ($estadoEnvio) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>';
    echo '<script>
        Swal.fire({
            title: "Tu correo",
            text: "Se envió correctamente",
            icon: "success"
        });
    </script>';
} else {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>';
    echo '<script>
        Swal.fire({
            title: "UPS!",
            text: "Algo salió mal",
            icon: "error"
        });
    </script>';
}
?>







