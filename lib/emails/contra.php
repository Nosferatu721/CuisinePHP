<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$nombre = $dataUser->nombre;
$apellido = $dataUser->apellido;
$email = $dataUser->email;
$pass = $dataUser->contrasena;

require 'lib/vendor/autoload.php';
require 'lib/emails/constante.php';
require 'opt/lampp/htdocs/lib/vendor/phpmailer/phpmailer/src/PHPMailer.php';
$mail = new PHPMailer(true);
try {
  $mail->SMTPDebug = 2;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;

  $mail->Username = 'elkintorres721@gmail.com';
  $mail->Password = 'Nosferatu72121';

  $mail->SMTPSecure = 'tsl';
  $mail->Port = 25;

  // Mensaje pa enviar
  $mail->setFrom('elkintorres721@gmail.com', 'CuisineSoft');
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Subject = tituloRecuperarPass;
  $mail->Body = '' . Mensaje . '<br>La contraseña de ' . $nombre . ' ' . $apellido . ' es: ' . '<b>' . $pass . '</b>';
  if ($mail->send()) {
    $_SESSION['recuperar'] = 'Enviado';
    header('Location: ' . baseUrl);
  }else
	  $_SESSION['recuperar'] = 'No Enviado';
} catch (Exception $e) {
  echo 'Algo salio mal' . $e->getMessage();
}
