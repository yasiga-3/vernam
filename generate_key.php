<?php
$plaintext = $_POST['plaintext'];
$plaintext = strtolower($plaintext);
$length = strlen($plaintext);

$characters = 'abcdefghijklmnopqrstuvwxyz';
$random_string = '';

// $array = explode(" ", $plaintext);

for ($i = 0; $i < $length; $i++) {
  if($plaintext[$i] == ' '){
    $random_string .= ' ';
    continue; 
  }
  // for ($j = 0; $j < strlen($array[$i]); $j++) {
  $random_string .= $characters[random_int(0, strlen($characters) - 1)];
  // } 
  // $random_string .= ' '.$random_string_for_a_word;
}


  $response = ["plaintext" => $plaintext,"random_key" => $random_string];
  echo json_encode($response);
// if($execute and $mail->send()){
//     $_SESSION['success_message'] = 'Success! Password reset successfully.Mail Sent!!';
//     header('Location:user_management.php');
// }
?>