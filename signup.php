<!-- Signup Script -->
<?php 
$error = array('name' =>  '', 'mail' => '', 'password' => '');
$message = '';

if (isset($_POST['signup'])) {

	//capturing user data into variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	//little validation (Checking for emptiness of registration fields.)
	if (empty($name)) {
		$error['name'] = 'Name field cannot be empty';
	} else if (empty($email)) {
		$error['mail'] = 'Email field cannot be empty';
	} else if (empty($password)) {
		$error['password'] = 'Password field cannot be empty';
	} else { 		//If all fields are not empty?

		//checking if a file named USERS.json exists?
		if (file_exists('users.json')) {
			$json_current_data = file_get_contents("users.json");

			//converting current JSON data to array
			$current_data_array = json_decode($json_current_data, true);

			//converting the newly inserted data into an array
			$new_data = array(
				'name' => $name,
				'email' => $email,
				'password' => md5($password)
			);

			//adding new data to existing JSON data
			$current_data_array[] = $new_data;

			//encoding the data into JSON file
			$prepared_data = json_encode($current_data_array);
			if (file_put_contents('users.json', $prepared_data)) {
				$message = "Account Created Successfully!";
			} else {
				$message = "Account could not be created!";
			}

		} else {
			$message = "JSON file does not exist!";
		}
	}
}

?>

<!-- Registration page code -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	    <script src="https://kit.fontawesome.com/7fb9f19e6f.js" crossorigin="anonymous"></script>
	<title>CodeX :: Sign-up</title>
</head>
<body>
	<main>
		<div id="box">
			<h1>codeX</h1>
			<p class="welcome_txt">Create Account</p>
			<br>
			<?php 
			if (!empty($message)) { ?>
				<script type="text/javascript">
					alert("<?php echo $message; ?>");
				</script>
			<?php } ?>
			<form class="signupForm" action='<?= $_SERVER["PHP_SELF"];?>' method="POST">
				<i class="fas fa-user"></i> &nbsp;<input type="name" name="name" placeholder="Full name" id="name" required>
				<div style="color: red;">
					<?php if ($error['name'] != '') {
						echo $error['name'];
					}  ?>	
				</div><br>
				<i class="fas fa-envelope"></i> &nbsp;<input type="email" name="email" placeholder="Email" id="mail" required>
				<div style="color: red; padding-bottom: 10px;">
					<?php if ($error['mail'] != '') {
						echo $error['mail'];
					}  ?>
				</div>
				<i class="fas fa-key"></i> &nbsp;<input type="password" name="password" placeholder="Password" id="pass" required>
				<div style="color: red; padding-bottom: 10px;">
					<?php if ($error['password'] != '') {
						echo $error['password'];
					}  ?>

				</div><br>
				<button class="btn-submit" type="submit" name="signup">Sign Up</button>
			</form>
			<p>Have an account already? <a class="green_link" href="index.php">Login here</a></p>
		</div>
	</main>
</body>
</html>