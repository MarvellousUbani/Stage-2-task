<!-- Login Script -->
<?php 
$error = array('mail' => '', 'password' => '', 'json' => '');
$user = FALSE;
$message = '';
$success = '';

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		$error['mail'] = 'Email field cannot be empty';
	} else if (empty($password)) {
		$error['password'] = 'Password field cannot be empty';
	} else {
		if (file_exists('users.json')) {
			$json_current_data = file_get_contents("users.json");

			//converting current JSON data to array
			$current_data_array = json_decode($json_current_data, true);


			if ($current_data_array) {
			    foreach ($current_data_array as $record_header => $record_details) {
			    	if ($record_details['email'] == $email && $record_details['password'] == md5($password)) {
			    		$user = TRUE;
			    		$success = 'Welcome '.$record_details['name'].' You\'re logged in! You are being redirected...'; 
			    	}
				}
			}
			if ($user == false) { 
				$message = 'Login Credentials Invalid! Kindly register or try again.';
			}
		} else {
			$error['json'] = "JSON file does not exist!";
		}
	}
}
?>

<!-- Login Page code -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	    <script src="https://kit.fontawesome.com/7fb9f19e6f.js" crossorigin="anonymous"></script>
	<title>CodeX :: Login</title>
</head>
<body>
	<main>
		<div id="box">
			<h1>codeX</h1>
			<p class="welcome_txt">Welcome back!</p>
			<p>New to codeX? 
				<a href="signup.php" class="green_link"> Sign Up</a>
			</p><br>

			<form class="loginForm" action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">
				<button><i class="fab fa-google"></i> Continue with Google</button>
				<input type="email" name="email" placeholder="Email" id="mail">
				<div style="color: red;">
					<?php if (count($error) > 1) {
						echo $error['mail'];
					}  ?>	
				</div><br>
				<input type="password" name="password" placeholder="Password" id="pass">
				<div style="color: red;">
					<?php if (count($error) > 1) {
						echo $error['password'];
					}  ?>	
				</div>
				<?php 
				if (!empty($message)) { ?>
	  				<p align="center" style="color: white; background-color: red; padding: 10px;">
	  					<?php echo $message; ?>
	  				</p><?php
				} if (!empty($success)) {?>
			    	<script type="text/javascript">
					alert("<?php echo $success; ?>");
				</script><?php
			    	$url = 'home.php';
			    	header("Refresh: 0; URL='$url'");
				} ?>
				<button class="btn-submit" type="submit" name="login">Continue with Email</button>
			</form>
			<a class="green_link f_right" href="#">Forgot Password?</a>
		</div>
	</main>
</body>
</html>