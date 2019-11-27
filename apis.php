<?php
error_reporting(0);
require_once(__DIR__ . '/vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;

function num($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
}
function random($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$email            = $_REQUEST['list'];
$username         = $_REQUEST['username'];
$password         = $_REQUEST['password'];
$option           = json_decode(urldecode($_REQUEST['option']));
$linkLetter       = $_REQUEST['letter'];
try {
  $mail             = new PHPMailer(true);
  $mail->SMTPDebug  = 0;
  $mail->isSMTP();
  $mail->Host       = 'smtp.office365.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = $username;
  $mail->Password   = $password;
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;

  $mail->setFrom($username, $option->from_name);
  $mail->addAddress($email);

  $message          = file_get_contents($linkLetter);
  $message          = str_replace('##email##', $email, $message);
  $message          = str_replace('##random_order##', strtoupper(random(10)), $message);
  $message          = str_replace('##acak##', num(6), $message);
  $message          = str_replace('##link##', $option->link . '?dispatch=' . random(30), $message);
  $message          = str_replace('##date##', time('r'), $message);

  $mail->isHTML(true);
  $mail->Subject    = $option->subject;
  $mail->Body       = $message;
  $mail->AltBody    = 'You does not support to see this message!';

  if ($mail->send()) {
    die('OK');
  } else {
    die('FAIL');
  }
} catch (Exception $e) {
  die('FAIL');
}
