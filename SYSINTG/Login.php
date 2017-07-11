<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

<?php
	$message ="";
	session_start();
	include 'dbconnection.php'; 
	if(isset($_POST['login'])) {
		$userName = $_POST['userName'];
		$passWord = $_POST['passWord'];
		$sql = "SELECT username, password FROM credentials WHERE username='{$userName}' AND password='{$passWord}'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION['currUser'] = $userName;
			header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/ViewData.php");
		}
		else {
			$message.="Login Error!";
		}
	}
?>

<form name="Login" method="post" action="" >
	Username: <input type="text" name="userName"> <br>
	Password: <input type="password" name="passWord"> <br>
	<input type="submit" name="login" value="Login"> <br>
	<?php echo $message; ?>
</form>

</body>
</html>