<?php 
    // Start the session
    session_start();
    include('database.php');
?>
<!doctype html>
<html>
<head>
	<title>Dashboard-Agriculture Management System</title>
	<link href="css/dashboard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/75ed5c4e40.js" crossorigin="anonymous"></script> 
<body>
<script src="sweetalert.min.js"></script>
<?php
if (isset($_SESSION['sussesadduser'])){
    echo "<script>
        swal({
        title: 'Success',
            text: 'Successfully Added New User',
            icon: 'success',
        });
    </script>";
    session_destroy ();
}

?>
	<div id="dashboard_main_container" >
		<div class="dashboard_content_container" id="dashboard_content_container">
            <div id="userAddFormcontainer">
                    <form action="x.php" method="POST" class="appForm" >
                        <div class="appFormInputContainer">
                            <lable for="first_name">First Name</lable>
                            <input type="text" class="appFormInput" id ="first_name" name="first_name"/>
                        </div>
                        <div class="appFormInputContainer">
                            <lable for="last_name">Last Name</lable>
                            <input type="text" class="appFormInput" id ="last_name" name="last_name"/>
                        </div>
                        <div class="appFormInputContainer">
                            <lable for="email">Email</lable>
                            <input type="text" class="appFormInput" id ="email" name="email"/> 
                        </div>
                        <div class="appFormInputContainer">
                            <lable for="password">Password</lable>
                            <input type="password" class="appFormInput" id ="password" name="password"/>
                        </div>
                        <button type="submit" name = 'adduser' class="appBtn" ><i class="fa fa-plus"></i>Add User</button>
                    </form>
                </div>
		</div>	
	</div>
	
<script src="js/script.js"></script>
</body>
</html>










