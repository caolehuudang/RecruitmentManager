<?php
session_start();
require_once('../Config/db.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
	
		$username = strip_tags(mysqli_real_escape_string($conn, trim($username)));
        $password = strip_tags(mysqli_real_escape_string($conn, trim($password)));
		//query
		$sql = "select * from users WHERE username  = '$username' ";
		$query = mysqli_query($conn, $sql);
		//$count = mysqli_num_rows($query);
		//$row = mysqli_fetch_array($query);
		//$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		if(mysqli_num_rows($query) > 0)  {
			$row = mysqli_fetch_array($query);
			//echo $row['password'];
			$hashed_password = $row['password'];
			if(password_verify($password,$hashed_password)){
                $_SESSION['username'] = $username;
				$_SESSION['id_user'] = $row['id_user'];
				$_SESSION['role'] = $row['role'];
				$_SESSION['fullname'] = $row['fullname'];
                header('Location: Admin.php');
                die();
			}
			else{
				echo "<div align='center' style='color: #555;border-radius: 10px;font-family: Tahoma, Geneva, Arial;font-size: 11px;padding: 10px 10px 10px 36px;margin: 20px 300px 0 300px;;background: pink;border: 1px solid #f2c779;'>
				<span style='font-weight: bold;text-transform: uppercase;'>Error: </span>
					Your Username or Password is wrong. Please try again !</div>";
			}
		}
		else{
			echo "<div align='center' style='color: #555;border-radius: 10px;font-family: Tahoma, Geneva, Arial;font-size: 11px;padding: 10px 10px 10px 36px;margin: 20px 300px 0 300px;;background: pink;border: 1px solid #f2c779;'>
				<span style='  font-weight: bold;text-transform: uppercase;'>Error: </span>
					Inter Username and Password !</div>";
		}

}
?>