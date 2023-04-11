<?php
session_start();
?>
<?php
include('database.php');
?>
<?php
if (!isset($_SESSION['user'])){
	//header('location:login.php');
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <noscript>
      <style type='text/css'>
        [data-aos] {
            opacity: 1 !important;
            transform: translate(0) scale(1) !important;
        }
      </style>
    </noscript>
	<style>
		[data-aos] {opacity: 1 !important;transform: translate(0) scale(1) !important;}

		* {box-sizing: border-box;margin:0;padding:0;font-style:Arial,sans-serif;}
		
		.header-1{
			background:#fff;display: flex;align-items: center;justify-content: space-between;padding:0.5% 5%;
			border-bottom:1px solid #fe2121;
		}

		.inputBox input , .inputBox select{
        	padding:7px;font-size: 1.7rem;background:#fff;text-transform: none;margin:1rem 0;
        	border:.1px solid #fe2121;width: 30%;outline:#f7f7f7;padding-left:1%;
        }

        table{width:80%;border-collapse:collapse;border:1px solid #fe2121;}
        th,td{padding:1%;border-collapse:collapse;border:1px solid #fe2121;width:15%;}
        th{font-size:16px;text-align:center;}
        td{font-size:16px;}
        a{text-decoration:none;color:#000;}
        
		@media(max-width:560px){
        	.header-1{
				background:#eee;display: inline-block;align-items: center;justify-content: center;padding:0.5% 5%;width:100%;
			}
        }

	</style>
</head>
<body>    
<div class="header-1">
    <h1 class='heading' style = 'margin-top:10px;'>
        <span style = 'color:#fe2121;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;'>Chats
    </h1>
</div>

<?php
    if (isset($_POST['submitbtn'])){
        $_SESSION['officer'] = $_POST['officer'];
        $officer = $_SESSION['officer'];
    }
    if (isset($_GET['officer'])){
        $_SESSION['officer'] = $_GET['officer'];
        $officer = $_SESSION['officer'];
    }
    $officer = $_SESSION['officer'];
?>
    <center>
    <div style = 'padding:1%;margin:10px auto;width:80%;border:1px solid #5CC074;' id = 'invoice'>
    <form action = "x.php" method = 'post'>
        <?php
            $sqlr = "SELECT * FROM chats where farmer = '$user' and officer = '$officer'";
            $resultr = $conn->query($sqlr);
            if ($resultr->num_rows > 0){
                $row = "";
                while($rowr = $resultr->fetch_assoc()){
                    if ($rowr['omsg'] !=""){
                        echo "<br><div style = 'float:left;font-size:18px;color:#fff;padding:2%;width:40%;border:none;background:#5CC074;border-bottom-left-radius:10px;border-bottom-right-radius:10px;border-top-right-radius:10px;'>" . $rowr['omsg'] . "</div><br><br>";
                    }
                    if ($rowr['fmsg'] !=""){
                        echo "<br><div style = 'float:right;font-size:18px;color:#fff;padding:2%;width:40%;border:none;background:#0f0;border-bottom-left-radius:10px;border-bottom-right-radius:10px;border-top-left-radius:10px;'>" . $rowr['fmsg'] . "</div><br><br><br>";
                    }
                }
            }
        ?>
        <br><br><br><br><br>
        <input type = 'text' name = 'message' placeholder = 'Type Message' style = 'padding:1%;width:60%;outline:#5CC074;'>
        <input type = 'submit' name = 'smsg' Value = 'Send Message' style = 'padding:1%;width:20%;'>
    </form>
    </div>
</body>
</html> 