<?
	function email($to, $from, $subject, $message) {
		require_once('/var/www/phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host       = $GLOBALS['smtpHost'];
		$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = $GLOBALS['mailSecurity'];
		$mail->Host       = $GLOBALS['smtpHost'];
		$mail->Port       = $GLOBALS['mailPort'];
		$mail->Username   = $GLOBALS['mailUser']['email'];
		$mail->Password   = $GLOBALS['mailPass'];
		$mail->SetFrom($from['email'], "{$from['name']}");
		$mail->AddReplyTo($from['email'], "{$from['name']}");
		$mail->Subject    = $subject;
		$mail->AltBody    = $GLOBALS['noHTML'];
		$mail->MsgHTML($message);
		$mail->AddAddress($to['email'], "{$to['name']}");

		return $mail->Send();
	}