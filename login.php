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
					header('Location: farmer-dashboard.php');
				}
				else{
					header('Location: officer-dashboard.php');
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
		if (isset($_SESSION['wrongpwd'])){
			echo "<script>
					swal({
						title: 'Error',
						text: 'Please Check your Password',
						icon: 'error',
					});
				</script>";
			session_destroy ();
		}
		if (isset($_SESSION['wrongemail'])){
			echo "<script>
					swal({
						title: 'Error',
						text: 'Please Check your Email',
						icon: 'error',
					});
				</script>";
			session_destroy ();
		}
	?>
	<div class="container">
		<div class="loginHeader">
			<h1>AMS</h1>
			<p>Agriculture Management System</P>
		</div>
		<div class= "loginBody">
			<form action="login.php" method="POST">
				<div class="logoinInputsContainer">
					<label for="">Email</label>
					<input placeholder="Email" name="username" type="text" />
				</div>
				<div class="logoinInputsContainer">
					<label for="">Password</label>
					<input placeholder="password" name="password" type="password" />
				</div>
				<div class="loginButton">
					<button name = "lbtn" type = 'submit'>login</button>
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