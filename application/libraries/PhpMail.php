<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhpMail
{
	protected $ci;

	public function __construct()
	{
		require FCPATH."vendor/autoload.php";
		$this->ci =& get_instance();
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host       = 'smtp.google.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                               // Enable SMTP authentication
		$mail->Username   = 'vihoangson@gmail.com';                 // SMTP username
		$mail->Password   = 'sonuyen117s';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to
		$mail->setFrom('from@example.com', 'Mailer');
		$mail->addAddress('ngotrichi@gmail.com', 'Joe User');     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}

	

}

/* End of file phpMail.php */
/* Location: ./application/libraries/phpMail.php */
