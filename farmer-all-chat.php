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
else{
    $user = $_SESSION['user'];
    $sqlr = "SELECT * FROM users where email = '{$user}'";
    $resultr = $conn->query($sqlr);
    if ($resultr->num_rows > 0){
        while($rowr = $resultr->fetch_assoc()){
            $fnamer = $rowr['fname'];
            $lnamer = $rowr['lname'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quality Tracking</title>
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
        <span style = 'color:#fe2121;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;'>Welcome </span><?php echo $fnamer . " " . $lnamer;?>
    </h1>
</div>

<?php
    $sqlr = "SELECT DISTINCT(officer) as officer FROM chats where farmer = '$user' group by officer";
    $resultr = $conn->query($sqlr);
    if ($resultr->num_rows > 0){
        $row = "";
        while($rowr = $resultr->fetch_assoc()){
            $officer = $rowr['officer'];
            $sql = "SELECT * FROM users where email = '{$officer}'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                }
                if ($row == ""){
                    $row = "<tr><td><a href = 'chat.php?farmer={$officer}'>{$fname} {$lname}</a></td></tr>";
                }
                else{
                    $row = "<tr><td><a href = 'chat.php?farmer={$officer}'>{$fname} {$lname}</a></td></tr>";
                }
            }
        }
    }
    else{
        $row = "<tr><td>No Chats Found</td></tr>";
    }
?>
    <div style = 'margin:10px auto;' id = 'invoice'>
    <center>
        <h1>All Chats</h1>
        <br>
        <table>
            <tr>
                <th>Officer</th>
                <?php
                    echo $row;
                ?>
            </tr>
        </table>
    </div>
     
</body>
</html> 