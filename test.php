<?php

	ini_set("display_errors", 1);
	
	include_once  'model/class/PHPMailer/class.phpmailer.php';

	# Criando o Objeto do Tipo PHPMailer
	$mail = new PHPMailer();

	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	
	# Define que a mensagem será SMTP
	$mail->IsSMTP(true);

	# Host do seu servidor de Email
	$mail->Host = "smtp.gmail.com";
	
	# Porta do Servidor de EMAIL
	$mail->Port = 587;
	
	# Segurança de envio de EMAIL : TLS/SSL	
	$mail->SMTPSecure = 'tls';

	# Segurança de autenticação do envio da Mensagem
	$mail->SMTPAuth = true; 
	
	# Usuário do servidor de email (pode ser o seu email)
	$mail->Username = 'utd.anthony@gmail.com'; // Usuário do servidor SMTP
	
	# Senha do usuário do servidor de email
	$mail->Password = '4478590000'; 


	# Define o remetente
	
	// Seu e-mail
	$mail->From = "alciliano@gmail.com"; 
	
	// Seu nome
	$mail->FromName = "Alciliano AnoAno";	

	# Define os destinatário(s)
	
	// Nome do email, Nome da pessoa a receber;	
	$mail->AddAddress('hefesto.angel@gmail.com', 'Angel');
	
	# Adicionando CC
	$mail->AddCC("anthonyjeff17@gmail.com","Anthony Jefferson");
	//$mail->AddCC("srluccasbrandao@gmail.com","Luccas Brandão");
	//$mail->AddCC("talysonroberto@gmail.com","Anthony Jefferson");
	//$mail->AddCC("youssfbr@gmail.com","Alysson Jose");
	

	# Define os dados técnicos da Mensagem
	
	# Define que o e-mail será enviado como HTML
	$mail->IsHTML(true); 

	# Define a mensagem (Texto e Assunto)

	# Título da Mensagem (Assunto)	
	$mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
	
	# O conteúdo da Mensagem
	$mail->Body = "Este é o corpo da mensagem de teste, em <b>HTML</b>!  :)";
	
	# Mensagem em texto plano
	//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";

	# Define os anexos (opcional)
	
	# Caminho (temporário) e o nome do arquivo	
	//$mail->AddAttachment("file:///var/www/html/project_final/view/profile_images/20180220090220_20180219110229_anthony.jpeg", "20180220090220_20180219110229_anthony.jpeg");  

	# Envia o e-mail
	// $sender = $mail->Send();

	# Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	// Exibe uma mensagem de resultado
	if ($sender) {
	  echo "E-mail enviado com sucesso!";
	}
	else {
	  echo "Não foi possível enviar o e-mail. <br>";
	  echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
	}

