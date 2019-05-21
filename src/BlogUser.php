<?php
session_start();
require_once('../Config/db.php');
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
<?php require_once ('./NavBar.php'); ?>
<br/><br/><br/><br/>
<div class = "uk-container">
<h2 class="uk-heading-divider">Blog</h2>
<br/>
<div class="uk-child-width-1-1@s uk-grid-match" uk-grid>
     <?php
        $sql = mysqli_query($conn,"select * from blog  ORDER BY id_blog desc");
        while ($result = mysqli_fetch_array($sql)) {
            $id_user = $result['id_user'];
            $sql2 = mysqli_query($conn,"select * from users where id_user = '$id_user'");
            while ($result2 = mysqli_fetch_array($sql2)) {
            ?>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <a href = "<?= $result['link'] ?>" target="_blank"><h3 class="uk-card-title"><?= $result['title'] ?> </h3></a>
                <p>Tác giả: <?= $result2['fullname']?></p>
            </div>
        </div>
<?php
        }
    }
    ?> 
    </div>
</div>

<br/><br/><br/><br/><br/><br/><br/><br/>
<?php require_once ('./Footer.php'); ?>

<script type="text/javascript">
        $(document).ready(function() {
            $('nav').addClass('black');
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
           
        });

</script>
</body>
</html>
