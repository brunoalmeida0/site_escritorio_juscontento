<?php;
   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $nome = $_POST["nome2"];
      $email = $_POST["email2"];
      $assunto = $_POST["assunto2"];
      $area = $_POST["area2"];
      $mensagem = $_POST["mensagem2"];
      $meuemail = "contatoassessoria@juscontento.com.br";
   }

	//UPLOAD DO ARQUIVO (SE HOUVER)
	$arquivo = isset($_FILES["uploaded_file"]) ? $_FILES["uploaded_file"] : FALSE;
   	if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
		$fp = fopen($_FILES["uploaded_file"]["tmp_name"],"rb");
		$anexo = fread($fp,filesize($_FILES["uploaded_file"]["tmp_name"]));
		$anexo = base64_encode($anexo);
		fclose($fp);
		$anexo = chunk_split($anexo);
		$boundary = "XYZ-" . date("dmYis") . "-ZYX";
		$mens = "--$boundary\n";	
		$mens .= "Content-Transfer-Encoding: 8bits\n";
		$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; //plain
		$mens .= "<b>Nome:</b> $nome<br>\n";
		$mens .= "<b>Assunto:</b> $assunto<br>\n";
		$mens .= "<b>Área:</b> $area<br>\n";
		$mens .= "<b>Mensagem:</b> $mensagem<br>\n";
		$mens .= "--$boundary\n";
		$mens .= "Content-Type: ".$arquivo["type"]."\n";
		$mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";
		$mens .= "Content-Transfer-Encoding: base64\n\n";
		$mens .= "$anexo\n";
		$mens .= "--$boundary--\r\n";
		$headers = "MIME-Version: 1.0\n";
		$headers .= "From: \"$nome\" <$email>\r\n";
		$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$headers .= "$boundary\n";
		//envio o email com o anexo
		mail($meuemail, $assunto, $mens, $headers);
	   } else {
	
	$assunto2 = "Formulário de contato: ".$assunto;

	$mensagem1 = "
		<html>
			<head>
				<title>Formulário de contato</title>
			</head>
			<body>
				<p><b>Nome: </b>".$nome."</p><br>
				<p><b>Área: </b>".$area."</p><br>
				<p><b>Mensagem: </b>".$mensagem."</p>
				
			</body>
		</html>
	";

   $to = "contatoassessoria@juscontento.com.br";
   $headers = "Content-Type: text/html; charset=UTF-8;"."\r\n"."From:".$email;
   @mail($to, '=?utf-8?B?'.base64_encode($assunto2).'?=', $mensagem1, $headers);
   }

   $headers2 = "Content-Type: text/html; charset=UTF-8;"."\r\n"."From:".$meuemail;
   $a_resposta = "Juscontento";
   $resposta = "
   <html>
   <head>
    <title>Juscontento</title>
   </head>
   <body>
   <p>Olá ".$nome.",<br><br>Sua mensagem foi recebida!<br>Em breve entraremos em contato!<br><br>Obrigado!</p>
   </body>
   </html>";
   @mail($email, $a_resposta, $resposta, $headers2);
   
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Sua mensagem foi enviada com sucesso.');
    window.location.href='../index.html';
    </SCRIPT>");
?>
