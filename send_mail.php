<?php 
session_start();
ob_start();
$email = $_SESSION['id'];
include_once("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$plaintext = $_POST['plaintext'];
$random_string = $_POST['random_key'];
$characters = 'abcdefghijklmnopqrstuvwxyz';
$enstr = "";
$length = strlen($plaintext);
for ($i = 0; $i < $length; $i++) {
    if($plaintext[$i] == ' '){
        $enstr .= ' ';
        continue;
    }
    $plain_pos = strpos($characters, $plaintext[$i]);
    $key_pos = strpos($characters, $random_string[$i]);
    $enpos = ($key_pos + $plain_pos) % 26;
    $enchar = $characters[$enpos];
    $enstr .= $enchar;
}
$result = '';

// for ($i = 0; $i < $length; $i++) {
//     $currentChar = $input[$i];
//     $previousChar = ($i == 0) ? $input[$length - 1] : $input[$i - 1];
//     $result .= $previousChar;
// }

for ($i = 0; $i < $length; $i++) {
    $currentChar = $enstr[$i];
    $nextChar = ($i == 0) ? $enstr[$length - 1] : $enstr[$i - 1];
    $result .= $nextChar;
}
$select = "insert into encryption(plain_text,random_key,encryption_text) values('".$plaintext."','".$random_string."','".$result."')";
$execute = mysqli_query($conn,$select);
// echo "<span>".$random_string." key successfully created ".$enstr." ".$result."</span>";
// $email = 'rajakkaniyasiga@gmail.com';
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->Host = 'smtp.gmail.com';
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Username = 'gopitaeri723@gmail.com';
$mail->Password = 'dawcdgkvnjgojcdg';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Subject = 'Your Encrypted Text';
$mail->setFrom('gopitaeri723@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$email_content = '
<body style="font-family: Arial, sans-serif;line-height: 1.6;background-color: #f9f9f9;margin: 0;padding: 0;">
  <div class="container" style="max-width: 600px;margin: 0 auto;padding: 20px;background-color: #ffffff;">
    <div class="message" style="margin-bottom: 20px;padding: 20px;background-color: #f2f2f2;">
      <p>Dear User,</p>
      <p>Your Encrypted Text Of Given Plain Text: '.$result.'</p>
    </div>
  </div>
</body>';
$mail->Body = $email_content;
// $mail->send();
if($mail->send()){
    echo 'Encryption text sent through Mail.';
}
?>