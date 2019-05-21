
<?php
session_start();
require_once('../Config/db.php');

if (isset($_SESSION['username']) == false) {
    header('Location: Login.php');
}else {
    $username=$_SESSION['username'];
    $sql = mysqli_query($conn,"select *from users WHERE  username = '$username'");
    $row = mysqli_fetch_array($sql);
    if ($row['role'] == 'USER' || $row['role'] == 'EMPLOYEE') {
        $_SESSION['role'] = $row['role'];
       ?>
        <script>
            window.location="Home.php"
        </script>
        <?php
    } else {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manager Employee</title>
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
  <link rel= " shortcut icon" href="../images/logo1.jpg" type="image/ico">
</head>
<body>
<?php require_once ('./NavBarAdmin.php'); ?>
<div class = "uk-container ">
<br/>
<h2 class="uk-heading-divider">Danh Sách Thành Viên</h2>
    <table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <tr>
            <th>STT</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
    <?php 
         $sql = mysqli_query($conn,"select  * from users");
         $count = 0;
            while ($result = mysqli_fetch_array($sql)) {
            $count++;
    ?>
        <tr>
            <td><?= $count ?></td>
            <td><?= $result['fullname'] ?></td>
            <td><?= $result['email'] ?></td>
            <td><?= $result['role'] ?></td>
            <td><a href = "./EditEmployee.php?id_user=<?= $result['id_user'] ?>" class = "uk-button uk-button-danger">Chỉnh Sửa</a></td>
        </tr>
    <?php
             }
    ?>
       
    </tbody>
</table>
<a class="uk-button uk-button-secondary" href="#modal-sections" uk-toggle>Thêm Nhân Viên</a>

<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Thêm Nhân Viên</h2>
        </div>
        <div class="uk-modal-body">
        <form class="uk-form-stacked" onsubmit="return checkInput()" method = "POST" action = "./RegisterAdmin.php">
            <div class="uk-margin">
                <label class="uk-form-label" for="username">Username</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="username" name = "username" type="text" placeholder="Username...">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="password">Password</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="password" name = "password" type="password" placeholder="Password...">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="fullname">FullName</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="fullname" name = "fullname" type="text" placeholder="FullName...">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="email">Email</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="email" name = "email" type="email" placeholder="Email...">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="role">Role</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="role" name = "role">
                        <option value = "ADMIN">ADMIN</option>
                        <option value = "USER">USER</option>
                    </select>
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
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            
        </div>
    </div>
</div>

    </div>
    <br/><br/>

<script type="text/javascript">

        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });
        $(window).on("scroll", function() {
            if($(window).scrollTop()) {
                $('nav').addClass('black');
            }

            else {
                $('nav').removeClass('black');
            }
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
</body>
</html>
<?php
    }
    }
?>