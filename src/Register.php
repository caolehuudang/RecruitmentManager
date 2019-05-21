<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
<?php require_once ('./NavBar.php'); ?>
<div class = "coverLogin">
    <div class = "uk-container">
    <br/><br/><br/><br/><br/><br/>
        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
            <div></div>
            <div>
                <div class="uk-card uk-card-default uk-card-body">
                    <h4>Register</h4>
                    <br/>
                    <form  onsubmit="return checkInput()" method = "POST" action = "./RegisterAction.php">
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input id= "username" class="uk-input" type="text" name = "username" placeholder = "Username" >
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input id= "password" class="uk-input" type="password" name = "password" placeholder = "Password">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input id= "password1" class="uk-input" type="password" name = "password1" placeholder = "Password">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: pencil"></span>
                                <input id= "fullname" class="uk-input" type="text" name = "fullname" placeholder = "Fullname">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input id= "email" class="uk-input" type="email" name = "email" placeholder = "Email">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input class="uk-input" type="submit" value = "Register" name = "Register">
                            </div>
                        </div>
                        <div id="fail-message-alert" class="alert alert-danger"
                         style="border-radius:10px;max-width: 500px; margin: auto; text-align: center;margin-bottom: 3%;display:none">
                         <span id="fail-message"></span>
                        </div>
                    </form>
                    <h5><a class="uk-link-heading" href="./Login.php">Login</a></h5>
                </div>
            </div>
            <div></div>
        </div>
    </div>

<br/><br/><br/><br/><br/><br/>
</div>
<?php require_once ('./Footer.php'); ?>

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
				$("#name").focus();
				return false;
			}
            if ($("#email").val() == ''){
				$("#fail-message").html("Vui lòng nhập Email");
				showError();
				$("#role").focus();
				return false;
			}
            if ($("#password").val() != $("#password1").val()){
				$("#fail-message").html("nhập lại password không đúng");
				showError();
				$("#password1").focus();
				return false;
			}
           
			return true;
        }
</script>
</body>
</html>
