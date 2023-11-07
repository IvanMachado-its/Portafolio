<?php

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['comment'])){
	$name=$_POST['name']; // Nombre
	$email=$_POST['email']; // Correo electrónico
	$subject=$_POST['subject']; // Asunto
	$comment=$_POST['comment']; // Comentario
	
	
	
	$html="<table><tr><td>Name:</td><td>$name</td></tr><tr><td>Email:</td><td>$email</td></tr><tr><td>Subject:</td><td>$subject</td></tr><tr><td>Comment:</td><td>$comment</td></tr></table>"; // HTML que contiene la tabla con los detalles del formulario

	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);

	// Configuraciones de SMTP
	$mail->isSMTP(); // Configurar el remitente para utilizar SMTP
	$mail->Host="smtp.gmail.com"; // Servidores SMTP
	$mail->Port=587; // Especificar el puerto SMTP
	$mail->SMTPSecure="tls"; // Habilitar el cifrado TLS, también se acepta `ssl`
	$mail->SMTPAuth=true; // Habilitar la autenticación SMTP
	$mail->Username="tu_correo@gmail.com";  // Tu correo
	$mail->Password="Tu_contraseña_de_aplicación"; // Tu contraseña de aplicación

	$mail->setFrom($email, $name);  
	$mail->addAddress("ivanmachado146@gmail.com", "Iván Machado"); // (Tu correo) Una dirección de correo electrónico que recibirá el correo electrónico con la salida del formulario

	$mail->IsHTML(true); // Establecer el formato de correo electrónico a HTML

	$mail->Subject = "(Ivan) Nueva información de contacto";
	$mail->Body = $html;

	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));

	$msg="";
	
	if($mail->send()){
		//echo "Correo enviado";
		$msg="Mensaje Enviado";
	}else{
		//echo "Ha ocurrido un error";
		$msg="Ha Ocurrido un Error";
	}
	echo $msg;
}
?>
