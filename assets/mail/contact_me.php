<?php
require_once('class.phpmailer.php');

// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['assunto']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}
	$name = strip_tags(htmlspecialchars($_POST['name']));
	$email = strip_tags(htmlspecialchars($_POST['email']));
	$assunto = strip_tags(htmlspecialchars($_POST['assunto']));
	$message = strip_tags(htmlspecialchars($_POST['message']));
	
    $destino = "contato@irdbr.com.br"; // Enviar email para mim.

    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPDebug = 1;
    $mailer->Port = 587; //Indica a porta de conexão para a saída de e-mails
    $mailer->Host = 'smtp.www28.locaweb.com.br'; //smtp.dominio.com.br
    $mailer->SMTPAuth = true; //define se haverá ou não autenticação no SMTP
    $mailer->Username = 'contato@irdbr.com.br'; //Informe o e-mai o completo
    $mailer->Password = 'Damiai@08'; //Senha da caixa postal
    $mailer->FromName = $assunto; //Nome que será exibido para o destinatário
    $mailer->From = 'contato@irdbr.com.br'; //Obrigatório ser a mesma caixa postal indicada em "username"
	$mailer->addReplyTo($email, $name);
    $mailer->AddAddress($destino,'NomeDestinatário'); //Destinatários
    $mailer->Subject = "Contato de:  $name";
    $mailer->Body = "Voce recebeu uma nova mensagem do formulario de contato do seu site.\n\n"."Aqui estao os detalhes:\n\nNome: $name\n\nEmail: $email\n\nassunto: $assunto\n\nMessage:\n$message";
    $mailer->Send();
    

?>