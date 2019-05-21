
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
  <title>Edit Blog</title>
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
<?php require_once ('./NavBarAdmin.php'); ?>
<div class = "uk-container ">
   
    <?php 
         $id_blog = $_GET['id_blog'];
         $sql = mysqli_query($conn,"select  * from blog where id_blog = '$id_blog'");
        
            while ($result = mysqli_fetch_array($sql)) {
            ?>
            <form class="uk-form-stacked" onsubmit="return checkInput()" method = "POST" action = "">
            <div class="uk-margin">
                <label class="uk-form-label" for="title">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="title" name = "title" type="text" value = "<?= $result['title'] ?>">
                </div>
            </div>
           
            <div class="uk-margin">
                <label class="uk-form-label" for="link">Link</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="link" name = "link" type="text" value = "<?= $result['link'] ?>">
                    <input class="uk-input" value = "<?php echo $_SESSION['id_user'] ?>" id="id_user" name = "id_user" type="hidden">
                </div>
            </div>
           
            <div class="uk-margin">
                <input class="uk-button uk-button-primary uk-text-right" name = "submit" type="submit" value = "Save" />
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
            if ($("#title").val() == ''){
				$("#fail-message").html("Vui lòng nhập Title");
				showError();
				$("#title").focus();
				return false;
			}
            if ($("#link").val() == ''){
				$("#fail-message").html("Vui lòng nhập link");
				showError();
				$("#link").focus();
				return false;
			}
			return true;
        }
</script>
<?php
if(isset($_POST['submit'])){
    $id_blog = $_GET['id_blog'];
    
    $title = $_POST['title'];
    $link = $_POST['link'];
   
    $update = mysqli_query($conn,"UPDATE blog SET title = '$title', link = '$link' 
     WHERE id_blog = '$id_blog'");
    ?>
    <script>
        window.location = "Blog.php"
     </script>
    <?php
}
?>

</body>
</html>
<?php
    }
    }
?>