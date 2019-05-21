<?php
session_start();
require_once('../Config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>All Jobs</title>
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
<h2 class="uk-heading-divider">Job Detail</h2>

<?php
    $id_post = $_GET['id_post']; 
      $sql = mysqli_query($conn,"select * from post where id_post = '$id_post'");
      while ($result = mysqli_fetch_array($sql)) {
          ?>
            <br/>
            <h5>Company: <?= $result['name_company'] ?> </h5>
            <br/>
            <h5>Title: <?= $result['title'] ?> </h5>
            <br/>
            <h5>Description: <?= $result['description'] ?> </h5>
            <br/>
            <h5>Salary: <?= $result['salary'] ?> đ </h5>
            <br/>
            <h5>Quatity: <?= $result['quatity'] ?> </h5>
            <br/>
            <h5>Location: <?= $result['location'] ?> </h5>
            <br/>

            <form enctype="multipart/form-data" method = "post" action ="">
                <div class="uk-margin" uk-margin>
                    <input  type="file" multiple  name = "cv" id = "cv">
                    <input class="btn btn-info" name = "submit" type="submit" value = "Upload CV" />
                </div>
            </form>
          <?php
      }
?>

</div>
<br/><br/><br/><br/><br/><br/><br/><br/>
<?php require_once ('./Footer.php'); ?>

<?php
    if(isset($_POST['submit'])){
            $name= $_FILES['cv']['name'];

            $tmp_name= $_FILES['cv']['tmp_name'];

            $position= strpos($name, "."); 

            $fileextension= substr($name, $position + 1);

            $fileextension= strtolower($fileextension);

            if (isset($name)) {

            $path= '../upload/';

                if (!empty($name)){
                    if (move_uploaded_file($tmp_name, $path.$name)) {
                    echo "<script> alert ('Upload Thành Công')</script>";
                    mysqli_query($conn,"insert into cv (id_post,name_cv) values('$id_post','$name')");
                    }
                }
            }
    }

?>


<script type="text/javascript">

        $(document).ready(function() {
            $('nav').addClass('black');
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });

            $.ajax({
            url: './CountView.php',
            type: 'POST',
            cache: false,
            data: "id_post= <?= $id_post ?>",
            success: function(string){
             console.log(string);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
        });
     
</script>
</body>
</html>
