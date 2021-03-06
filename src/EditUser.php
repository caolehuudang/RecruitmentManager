
<?php
session_start();
require_once('../Config/db.php');

if (isset($_SESSION['username']) == false) {
    header('Location: Login.php');
}else {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<?php require_once ('./NavBar.php'); ?>
<br/><br/><br/><br/>
<div class = "uk-container ">
   
    <?php 
         $id = $_GET['id_user'];
         $sql = mysqli_query($conn,"select  * from users where id_user = '$id'");
        
            while ($result = mysqli_fetch_array($sql)) {
            ?>
            <form class="uk-form-stacked" onsubmit="return checkInput()" method = "POST" action = "">
            <div class="uk-margin">
                <label class="uk-form-label" for="username">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="username" disabled name = "username" type="text" value = "<?= $result ['username']?>">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="password">Password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="password" name = "password" type="password" value = "">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="fullname">FullName</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="fullname" name = "fullname" type="text" value = "<?= $result ['fullname']?>">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="email">Email</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="email" name = "email" type="email" value = "<?= $result ['email']?>">
                </div>
            </div>
           
            <div class="uk-margin">
                <input class="uk-button uk-button-primary uk-text-right" name = "save" type="submit" value = "Save" />
            </div>
            <div id="fail-message-alert" class="alert alert-danger"
                style="border-radius:10px;max-width: 500px; margin: auto; text-align: center;margin-bottom: 3%;display:none">
            <span id="fail-message"></span>
            </div>
        </form>
            <?php
            }
    ?>
       
    </div>

<script type="text/javascript">

        $(document).ready(function() {
            $('nav').addClass('black');
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });
       
        function showError() {
            $("#fail-message-alert").fadeIn(1500);
            setTimeout(function () {
                $("#fail-message-alert").fadeOut(1000);
            },3000);
        }
        function checkInput(){
            if ($("#username").val() == ''){
				$("#fail-message").html("Vui lòng nhập username");
				showError();
				$("#username").focus();
				return false;
			}
			if ($("#password").val() == ''){
				$("#fail-message").html("Vui lòng nhập password");
				showError();
				$("#password").focus();
				return false;
            }
            if ($("#password").val().length  < 6){
				$("#fail-message").html("Password phải trên 6 chữ ");
                showError();
				$("#password").focus();
				return false;
            }
            if ($("#password1").val() == ''){
				$("#fail-message").html("Vui lòng nhập lại password");
				showError();
				$("#password1").focus();
				return false;
            }
            if ($("#fullname").val() == ''){
				$("#fail-message").html("Vui lòng nhập Full name");
				showError();
				$("#fullname").focus();
				return false;
			}
            if ($("#email").val() == ''){
				$("#fail-message").html("Vui lòng nhập Email");
				showError();
				$("#email").focus();
				return false;
			}
           
			return true;
        }
</script>
<?php
if(isset($_POST['save'])){
    $id = $_GET['id_user'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
   
    $update = mysqli_query($conn,"UPDATE users SET password = '$hashed_password', fullname = '$fullname', 
    email = '$email' WHERE id_user = '$id'");
    ?>
    <script>
        window.location = "Profile.php?"
     </script>
    <?php
}
?>

</body>
</html>
<?php
    }

?>