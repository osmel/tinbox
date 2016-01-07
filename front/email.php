<?php
$ccr_subject = ' Ajax HTML Contact Form : Demo'; // Subject of your email
$to = $_REQUEST['email'];  //Recipient's E-mail 
// Change $to = $_REQUEST['email']; with your own email id or where you want to receive
// example $to = "email@yoursite.com";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "From: " . $_REQUEST['email'] . "\r\n"; // Sender's E-mail
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$ccr_message .= 'Name: ' . $_REQUEST['name'] . "<br>";
$ccr_message .= $_REQUEST['message'];

if (@mail($to, $ccr_subject, $ccr_message, $headers))
{
	// Transfer the value 'sent' to ajax function for showing success message.
	echo 'sent';
}
else
{
	// Transfer the value 'failed' to ajax function for showing error message.
	echo 'failed';
}
?>