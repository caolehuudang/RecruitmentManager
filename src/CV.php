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
  <title>Profile</title>
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


<div class = "uk-container">
<h4 class ="uk-text-success">Danh Sách Tuyển Dụng</h4>
<table class="uk-table uk-table-hover uk-table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
       $id_post = $_GET['id_post'];
       $count = 0;
        $sql_cv = mysqli_query($conn,"select  * from cv where id_post = '$id_post'");
        while ($result = mysqli_fetch_array($sql_cv)) {
            $count++;
            $files_field = $result['name_cv'];
            $files_show = "../upload/$files_field";
        ?>
        <tr>
            <td><?= $count?></td>
            <td><?= $result['name_cv'] ?></td>
            <td>
                 <a class="uk-button uk-button-link" href='<?= $files_show ?>'>DownLoad</a>
            </td>
        </tr>
        <?php
     }
      ?>
       
    </tbody>
</table>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
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

<?php
}
?>
