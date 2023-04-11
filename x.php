<?php 
    // Start the session
    session_start();
    include('database.php');
?>
<?php
if (isset($_POST['adduser'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sqli = "insert into users(fname,lname,email,pasword,type)values('$first_name','$last_name','$email','$hash','officer')";
    if($conn->query($sqli) === TRUE){
        $_SESSION['sussesadduser'] = 1;
        echo "<script>window.history.back()</script>";
    }                      
}
if(isset($_GET['logoutemail'])){
    session_destroy();
    header('Location: index.php');
}   
    
if(isset($_POST['sbtn'])){
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $sql = "SELECT * FROM users where email = '{$username}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $_SESSION['alreadyuser'] = 100;
        echo "<script>window.history.back()</script>";
    }
    else{
        if($password == $rpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sqli = "insert into users(fname,lname,email,pasword,type)values('$first_name','$last_name','$username','$hash','farmer')";
            if($conn->query($sqli) === TRUE){
                $_SESSION['user'] = $username;
                header('Location:farmer-dashboard.php');
            } 
        }
        else{
            $_SESSION['signupfail'] = 100;
            echo "<script>window.history.back()</script>";
        }
    }
}

if (isset($_POST['smsg'])){
    $message = $_POST['message'];
    $officer = $_SESSION['officer'];
    $user = $_SESSION['user'];
    $sqli = "insert into chats(farmer,officer,fmsg)values('$user','$officer','$message')";
    if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
    }
}
if (isset($_POST['smsgofficer'])){
    $message = $_POST['message'];
    $farmer = $_SESSION['farmer'];
    $user = $_SESSION['user'];
    $sqli = "insert into chats(farmer,officer,omsg)values('$farmer','$user','$message')";
    if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
    }
}
?>

    