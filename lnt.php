<?php
error_reporting(0);
set_time_limit(0);
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/func.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email            = $_REQUEST['list'];
$username         = $_REQUEST['username'];
$password         = $_REQUEST['password'];
$option           = json_decode(urldecode($_REQUEST['option']));

$linkLetter       = $_REQUEST['letter'];
try {
  $mail             = new PHPMailer(false);
  $mail->CharSet    = 'UTF-8';
  $mail->SMTPDebug  = 0;
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = $username;
  $mail->Password   = $password;
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->setFrom($username, $option->from_name);
  $mail->addAddress($email);
  $device  		= [
'iPhone 6',
'iPhone 6 Plus',
'iPhone 6s',
'iPhone 6s Plus',
'iPhone 7',
'iPhone 7 Plus',
'iPhone 8',
'iPhone 8 Plus',
'iPhone X',
'iPhone XR',
'iPhone XS',
'iPhone XS Max',
];



  $location         = [
'Banda Aceh, Aceh, Indonesia',
'Langsa, Aceh, Indonesia',
'Lhokseumawe, Aceh, Indonesia',
'Meulaboh, Aceh, Indonesia',
'Sabang, Aceh, Indonesia',
'Subulussalam, Aceh, Indonesia',
'Denpasar, Bali, Indonesia',
'Pangkalpinang, Bangka Belitung, Indonesia',
'Cilegon, Banten, Indonesia',
'Serang, Banten, Indonesia',
'Tangerang Selatan, Banten, Indonesia',
'Tangerang, Banten, Indonesia',
'Bengkulu, Bengkulu, Indonesia',
'Gorontalo, Gorontalo, Indonesia',
'Jakarta Barat, Jakarta, Indonesia',
'Jakarta Pusat, Jakarta, Indonesia',
'Jakarta Selatan, Jakarta, Indonesia',
'Jakarta Timur, Jakarta, Indonesia',
'Jakarta Utara, Jakarta, Indonesia',
'Sungai Penuh, Jambi, Indonesia',
'Jambi, Jambi, Indonesia',
'Bandung, Jawa Barat, Indonesia',
'Bekasi, Jawa Barat, Indonesia',
'Bogor, Jawa Barat, Indonesia',
'Cimahi, Jawa Barat, Indonesia',
'Cirebon, Jawa Barat, Indonesia',
'Depok, Jawa Barat, Indonesia',
'Sukabumi, Jawa Barat, Indonesia',
'Tasikmalaya, Jawa Barat, Indonesia',
'Banjar, Jawa Barat, Indonesia',
'Magelang, Jawa Tengah, Indonesia',
'Pekalongan, Jawa Tengah, Indonesia',
'Purwokerto, Jawa Tengah, Indonesia',
'Salatiga, Jawa Tengah, Indonesia',
'Semarang, Jawa Tengah, Indonesia',
'Surakarta, Jawa Tengah, Indonesia',
'Tegal, Jawa Tengah, Indonesia',
'Batu, Jawa Timur, Indonesia',
'Blitar, Jawa Timur, Indonesia',
'Kediri, Jawa Timur, Indonesia',
'Madiun, Jawa Timur, Indonesia',
'Malang, Jawa Timur, Indonesia',
'Mojokerto, Jawa Timur, Indonesia',
'Pasuruan, Jawa Timur, Indonesia',
'Probolinggo, Jawa Timur, Indonesia',
'Surabaya, Jawa Timur, Indonesia',
'Pontianak, Kalimantan Barat, Indonesia',
'Singkawang, Kalimantan Barat, Indonesia',
'Banjarbaru, Kalimantan Selatan, Indonesia',
'Banjarmasin, Kalimantan Selatan, Indonesia',
'Palangkaraya, Kalimantan Tengah, Indonesia',
'Balikpapan, Kalimantan Timur, Indonesia',
'Bontang, Kalimantan Timur, Indonesia',
'Samarinda, Kalimantan Timur, Indonesia',
'Tarakan, Kalimantan Utara, Indonesia',
'Batam, Kepulauan Riau, Indonesia',
'Tanjungpinang, Kepulauan Riau, Indonesia',
'Bandar Lampung, Lampung, Indonesia',
'Metro, Lampung, Indonesia',
'Ternate, Maluku Utara, Indonesia',
'Tidore Kepulauan, Maluku Utara, Indonesia',
'Ambon, Maluku, Indonesia',
'Tual, Maluku, Indonesia',
'Bima, Nusa Tenggara Barat, Indonesia',
'Mataram, Nusa Tenggara Barat, Indonesia',
'Kupang, Nusa Tenggara Timur, Indonesia',
'Sorong, Papua Barat, Indonesia',
'Jayapura, Papua, Indonesia',
'Dumai, Riau, Indonesia',
'Pekanbaru, Riau, Indonesia',
'Makassar, Sulawesi Selatan, Indonesia',
'Palopo, Sulawesi Selatan, Indonesia',
'Parepare, Sulawesi Selatan, Indonesia',
'Palu, Sulawesi Tengah, Indonesia',
'Bau-Bau, Sulawesi Tenggara, Indonesia',
'Kendari, Sulawesi Tenggara, Indonesia',
'Bitung, Sulawesi Utara, Indonesia',
'Kotamobagu, Sulawesi Utara, Indonesia',
'Manado, Sulawesi Utara, Indonesia',
'Tomohon, Sulawesi Utara, Indonesia',
'Bukittinggi, Sumatra Barat, Indonesia',
'Padang, Sumatra Barat, Indonesia',
'Padangpanjang, Sumatra Barat, Indonesia',
'Pariaman, Sumatra Barat, Indonesia',
'Payakumbuh, Sumatra Barat, Indonesia',
'Sawahlunto, Sumatra Barat, Indonesia',
'Solok, Sumatra Barat, Indonesia',
'Lubuklinggau, Sumatra Selatan, Indonesia',
'Pagaralam, Sumatra Selatan, Indonesia',
'Palembang, Sumatra Selatan, Indonesia',
'Prabumulih, Sumatra Selatan, Indonesia',
'Binjai, Sumatra Utara, Indonesia',
'Medan, Sumatra Utara, Indonesia',
'Padang Sidempuan, Sumatra Utara, Indonesia',
'Pematangsiantar, Sumatra Utara, Indonesia',
'Sibolga, Sumatra Utara, Indonesia',
'Tanjungbalai, Sumatra Utara, Indonesia',
'Tebingtinggi, Sumatra Utara, Indonesia',



  ];
  $location         = $location[rand(0, count($location)-1)];
  $device         	= $device[rand(0, count($device)-1)];
  $num              = strtoupper(num(6));
  $pdfname          = 'Order_#' . $option->order_id . '.pdf';
  $message          = file_get_contents(__DIR__ . '/source/letters.html');

  $message          = str_replace('##email##', $email, $message);
  $message          = str_replace('##random##', strtoupper(random(10)), $message);
  $message          = str_replace('##acak##', $option->order_id, $message);
  $message          = str_replace('##link##', $option->link . '?dispatch=' . random(30), $message);
  $message          = str_replace('##date##', date('d F Y'), $message);
  $message          = str_replace('!kimbek!', num(10), $message);
  $message          = str_replace(array('DKI Jakarta, DKI DKI Jakarta, ID', '##location##'), $location, $message);
  $message          = str_replace(array('iPhone XS Max', '##device##'), $device, $message);
  $message          = str_replace('##price##', rand(8, 20) . '.00', $message);
  $subject          = str_replace('##location##', $location, $option->subject);
  $subject          = str_replace('##device##', $device, $option->subject);
  $subject          = str_replace('##random##', strtoupper(random(10)) , $option->subject);

  $mail->isHTML(false);
  $mail->Subject    = $subject;
  $mail->Body       = $message;
  $mail->AltBody    = $message;
  $send             = $mail->send();
  @unlink($pdfname);
  if ($send) {
    die('OK');
  } else {
    die($mail->ErrorInfo);
  }
} catch (Exception $e) {
  die($mail->ErrorInfo);
  // die('Exception');
}
