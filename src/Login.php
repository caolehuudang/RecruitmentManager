<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        header('Location:Admin.php');
    }
?>
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
    <br/><br/><br/><br/><br/><br/><br/><br/>
        <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
            <div></div>
            <div>
                <div class="uk-card uk-card-default uk-card-body">
                    <h4>Login</h4>
                    <br/>
                    <form method = "POST" action = "./LoginAction.php">
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" name = "username" placeholder = "username">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name = "password" placeholder = "password">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input class="uk-input" type="submit" value = "login" name = "login">
                            </div>
                        </div>
                    </form>
                    <h5><a class="uk-link-heading" href="./Register.php">Register</a></h5>
                </div>
            </div>
            <div></div>
        </div>
    </div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/>
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
        })
</script>

</body>
</html>
