<?php
session_start();
ob_start();
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>vernam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          			<i class="fa fa-bars"></i>
	          			<span class="sr-only">Toggle Menu</span>
	        		</button>
        		</div>
				<div class="p-4 pt-5">
		  			<h1><a href="encrypt.php" class="logo">Vernam</a></h1>
	        		<ul class="list-unstyled components mb-5">
	          			<li class="active">
	              			<a href="encrypt.php">Encrypt</a>
	          			</li>
	          			<li>
              				<a href="decrypt.php">Decrypt</a>
	          			</li>
						<li>
              				<a href="index.php">Logout</a>
	          			</li>
	        		</ul>
	            </div> 
    	    </nav>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5 pt-5">
				<div id="message"></div>
				<form method="post" id="encrypt_form">
					<h2 class="mb-4">Encrypt</h2>
					<div class="form-group row">
					  <label for="plaintext" class="col-sm-2 col-form-label">Plain Text</label>
					  <div class="col-sm-10">
						<input type="text" placeholder="Plaintext" name="plaintext" class="form-control" id="plaintext" onInput="checkSpecialCharacters()">
					    <span id="validation_msg" style="color:red;display:none">Plaintext contains uppercase or special character or numeric value</span>
					  </div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-5">
						  <input type="submit" class="form-control btn-primary" id="generate_key" value="Generate key" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-5">
						  <input type="submit" class="form-control btn-primary" id="encryption" value="Encryption" />
						</div>
					</div>
					<div class="form-group row">
					  <label for="random_key" class="col-sm-2 col-form-label">Random key</label>
					  <div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="random_key" value="#######">
					  </div>
					</div>
					<!-- <div class="form-group row">
					  <label for="before_shift" class="col-sm-2 col-form-label">Encrypted text before shift</label>
					  <div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="before_shift" value="#######">
					  </div>
					</div>
					<div class="form-group row">
					  <label for="encrypted_text" class="col-sm-2 col-form-label">Encrypted Text</label>
					  <div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="encrypted_text" value="#######">
					  </div>
					</div> -->
				</form>
      		</div>
		</div>
	<script>
		jQuery(document).ready(function($) {
		jQuery("#generate_key").click(function(e){
			$.ajax({
				url: 'generate_key.php',
				data: {plaintext: $('#plaintext').val()},
				method: 'POST',
				success: function(data){
					console.log(data);
					data = JSON.parse(data);
					
      				$('#message').html("Random key generated.");
      				$('#plaintext').val(data.plaintext);
					$('#random_key').val(data.random_key);
    			}
			});
			e.preventDefault();
  		});
  		jQuery("#encryption").click(function(e){
			$.ajax({
				url: 'send_mail.php',
				data: {plaintext: $('#plaintext').val(),random_key: $('#random_key').val()},
				method: 'POST',
				success: function(data){
					console.log(data);
					
      				$('#message').html(data);
    			}
			});
			e.preventDefault();
  		});
	});
	function checkSpecialCharacters(){
let str = $('#plaintext').val();
    let specialChars = "abcdefghijklmnopqrstuvwxyz ";

    for (var i = 0; i < str.length; i++) {
        if (specialChars.indexOf(str[i]) === -1) {
            // Found a character that is not a special character or numeric value
            // Disable the elements and return
            document.getElementById("generate_key").disabled = true;
            document.getElementById("encryption").disabled = true;
            document.getElementById("validation_msg").style.display = "block";
            return;
        }
    }
    // No special characters or numeric values found, enable the elements
    document.getElementById("generate_key").disabled = false;
    document.getElementById("encryption").disabled = false;
    document.getElementById("validation_msg").style.display = "none";
}
	</script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>