<?php
	//start the session
	session_start();
	include('database.php');
	$error_message ='';

	if(isset($_POST['lbtn'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM users where email = '{$username}'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$pwd = $row['pasword'];
				$type = $row['type'];
			}
			$verifypwd = password_verify($password, $pwd);
			if($verifypwd){
				$_SESSION['user'] = $username;
				if($username == 'admin@gmail.com'){
					header('Location: dashboard.php');
				}
				else if($type == 'farmer'){
					header('Location: farmer.php');
				}
				else{
					header('Location: officer.php');
				}
			}
			else{
				$_SESSION['wrongpwd'] = 100;
			}
		}
		else{
			$_SESSION['wrongemail'] = 100;
		}
		
	}
		
?>


<!doctype html>
<head>
	<title>Login</title>
	<link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<script src="sweetalert.min.js"></script>

	<?php
		if (isset($_SESSION['alreadyuser'])){
			echo "<script>
					swal({
						title: 'Error',
						text: 'the user already exits',
						icon: 'error',
					});
				</script>";
			session_destroy ();
		}
		if (isset($_SESSION['signupfail'])){
			echo "<script>
					swal({
						title: 'Error',
						text: 'Password doesnt match',
						icon: 'error',
					});
				</script>";
			session_destroy ();
		}
	?>
	<div class="container">
		<div class="loginHeader">
			<h1 style = "color:#5CC074;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;">AMS</h1>
			<p>Farmer Registration</P>
		</div>
		<div class= "loginBody">
			<form action="x.php" method="POST">
                <div class="logoinInputsContainer">
					<label for="">First Name</label>
					<input placeholder="First name" name="fname" type="text" />
				</div>
                <div class="logoinInputsContainer">
					<label for="">Last Name</label>
					<input placeholder="Last name" name="lname" type="text" />
				</div>
				<div class="logoinInputsContainer">
					<label for="">Email</label>
					<input placeholder="username" name="username" type="text" />
				</div>
                <br>
				<div class="logoinInputsContainer">
					<label for="">Password</label>
					<input placeholder="password" name="password" type="password" />
				</div>
                <br>
                <div class="logoinInputsContainer">
					<label for="">Re-type Password</label>
					<input placeholder="password" name="rpassword" type="password" />
				</div>
				<div class="loginButton">
					<button name = "sbtn" type = 'submit'>Register</button>
				</div>
			</form>
		</div>
	</div>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>