<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - GMail SMTP test</title>
</head>
<body>

<form action="" method = "post">
	<table>
		<tr>
			<td>Tiêu đề:</td>
			<td> <input type="text" name ="subject" ></input> </td>
		</tr>
		<tr>
			<td>Họ Tên:</td>
			<td> <input type="text" name ="name" ></input> </td>
		</tr>
		<tr>
			<td>Email:</td>
			<td> <input type="text" name ="email" ></input> </td>
		</tr>
		<tr>
			<td>Nội Dung:</td>
			<td> <input type="text" name ="body" ></input> </td>
		</tr>
		<tr>
			
			<td> <input type="submit" name ="send">Gửi</input> </td>
		</tr>
	</table>
 </form>

<?php

if(isset($_POST["send"])){
	$sb = $_POST["subject"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$body = $_POST["body"];


//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require './PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "nhiyentran8@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Dang0918930113";

//Set who the message is to be sent from
$mail->setFrom('nhiyentran8@gmail.com', 'Nhi nhi');

//Set an alternative reply-to address
$mail->addReplyTo('nhiyentran8@gmail.com', 'Nhi nhi');

//Set who the message is to be sent to
$mail->addAddress($email, $name);

//Set the subject line
$mail->Subject = 'TDTU Quiz Online';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($body);

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
}
?>
</body>
</html>
