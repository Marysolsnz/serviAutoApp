<?php
// the message
$msg = "Chava pedorro \nHueles a cola";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("salvador.ahedo@gmail.com","Very important",$msg);
?>
