<?php
	include('class.phpmailer.php');
	$mail = new PHPMailer(true);
	$mail->IsSMTP();	
    //$mail->Port = 26;
	$mail->Port = 25;
    //$mail->SMTPSecure = "pop3";
    //$mail->SMTPSecure ="tls";
    $mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = false;
	$mail->SMTPDebug  = 2;
	$mail->Timeout=30;
	$mail->Username = 'sgvnotificaciones@gmail.com';
	$mail->Password = 'ezwafbfnimwmnfyx'; 
 	$mail->From = "afiliaciones@sgvc.co";
	$mail->FromName = "Servicios Generales del valle";
	$mail->Subject = "Mensaje del SGV";
	$mail->CharSet = 'UTF-8';

	
?>
