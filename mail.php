<?php
$to = "kamilwaresiak@gmail.com"; 
$subject = "Test mail PHP"; 
$content = "The body/content of the Email";
$headers = "From: Website <SendingEmail@address.tld>\r\nReply-To: SendingEmail@address.tld";

if (mail($to, $subject, $content, $headers))
echo "The email has been sent successfully!";
else
echo "Email did not leave correctly!";
?>