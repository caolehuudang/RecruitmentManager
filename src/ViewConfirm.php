
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
  <title>Admin</title>
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
   <div class = "uk-container">
        <h2 class="uk-heading-divider">Thông Tin Bài Duyệt</h2>

    <table class="uk-table uk-table-divider">
    <thead>
        <tr>
            <th>STT</th>
            <th>COMPANY</th>
            <th>TITLE</th>
            <th>VIEW DETAIL</th>
        </tr>
    </thead>
    <tbody>
    <?php
         $sql = mysqli_query($conn,"select * from post where confirm = 'F' and status = 'T'");
         $count_sql = mysqli_query($conn,"select COUNT(*) as tmp from post where confirm = 'F' and status = 'T'");
         $tmp = mysqli_fetch_assoc($count_sql);
         $count = 0;
         if($tmp['tmp'] == 0){
            echo " <tr>
                <td></td>
                <td></td>
                 <td> <h3>Chưa có bài viết mới </h3></td>
                 <td></td>
                </tr>";
         }
         while ($result = mysqli_fetch_array($sql)) {
        $count ++;
       
    ?>
        <tr>
            <td><?= $count ?></td>
            <td><?= $result['name_company'] ?></td>
            <td><?= $result['title'] ?></td>
            <td>
                <a href="./Confirm.php?id_post=<?= $result['id_post'] ?>&id_user= <?= $result['id_user'] ?>" class = "uk-button uk-button-secondary">View</a>
            </td>
        </tr>
    <?php 
         }
    ?>
    </tbody>
</table>
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
        
</script>
</body>
</html>
<?php
    }
    }
?>