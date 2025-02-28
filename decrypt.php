<?php
session_start();
ob_start();
if(!isset($_SESSION['id'])){
    header('Location:index.php');
}
include_once("connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>vernam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
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
	          			<li>
	              			<a href="encrypt.php">Encrypt</a>
	          			</li>
	          			<li class="active">
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
				<form method="post" id="decrypt_form">
					<h2 class="mb-4">Decrypt</h2>
					<div class="form-group row">
					  <label for="encryptedtext" class="col-sm-2 col-form-label">Encrypted Text</label>
					  <div class="col-sm-5">
						<input type="text" class="form-control" placeholder="Encrypted Text" id="encrypted_text">
					  </div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-5">
						  <input type="submit" class="form-control btn-primary" id="get_key" value="Decrypt" />
						</div>
					  </div>
					<div class="form-group row">
					  <label for="decrypted_text" class="col-sm-2 col-form-label">Decrypted Text</label>
					  <div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="decrypted_text" value="#######">
					  </div>
					</div>
				</form>
      		</div>
		</div>
		<script>
		jQuery(document).ready(function($) {
		jQuery('#decrypt_form').on('submit',function(e){

			$.ajax({
				url: 'get_key.php',
				data: {encrypted_text: $('#encrypted_text').val()},
				method: 'POST',
				success: function(result){
					//$('#message').html(result);
      				$('#message').html("successfully Decrypted");
					$('#decrypted_text').val(result);
    			}
			});
			e.preventDefault();
  		});
	});
	</script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>