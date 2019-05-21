
<?php
session_start();
require_once('../Config/db.php');

if (isset($_SESSION['username']) == false) {
    header('Location: Login.php');
}else {
    $username=$_SESSION['username'];
    $sql = mysqli_query($conn,"select *from users WHERE  username = '$username'");
    $row = mysqli_fetch_array($sql);
    if ($row['role'] == 'USER') {
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
  <title>Blog</title>
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
<h2 class="uk-heading-divider">Danh Sách Bài Viết</h2>
    <table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <tr>
            <th>STT</th>
            <th>Title</th>
            <th>link</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
    <?php 
         $sql = mysqli_query($conn,"select  * from blog");
         $count = 0;
            while ($result = mysqli_fetch_array($sql)) {
            $count++;
           
    ?>
        <tr>
            <td><?= $count ?></td>
            <td><?= $result['title'] ?></td>
            <td><?= $result['link'] ?></td>
            <td><a href = "./EditBlog.php?id_blog=<?= $result['id_blog'] ?>" class = "uk-button uk-button-danger">Chỉnh Sửa</a></td>
        </tr>
    <?php
             }
    ?>
       
    </tbody>
</table>
<a class="uk-button uk-button-secondary" href="#modal-sections" uk-toggle>Đăng bài</a>

<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Blog</h2>
        </div>
        <div class="uk-modal-body">
        <form class="uk-form-stacked" onsubmit="return checkInput()" method = "POST" action = "./BlogAction.php">
            <div class="uk-margin">
                <label class="uk-form-label" for="title">Title</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="title" name = "title" type="text" placeholder="title...">
                </div>
            </div>
           
            <div class="uk-margin">
                <label class="uk-form-label" for="link">Link</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="link" name = "link" type="text" placeholder="link...">
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
</body>
</html>
<?php
    }
    }
?>