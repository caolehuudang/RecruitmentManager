
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
  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
       
        var data = google.visualization.arrayToDataTable([
            ['x', 'Y'],
          <?php 
           $chart_10 = mysqli_query($conn,"select count(*) as diem_10 from post");
           $result_10 = mysqli_fetch_array($chart_10);

           $chart_89 = mysqli_query($conn,"select count(*) as diem_89 from post where confirm = 'T' and status = 'T'");
           $result_89 = mysqli_fetch_array($chart_89);

           $chart_67 = mysqli_query($conn,"select count(*) as diem_67 from post where confirm = 'F' and status = 'T'");
           $result_67 = mysqli_fetch_array($chart_67);

     

                echo "['Tổng bài Post',".$result_10['diem_10']."],";
                echo "['Đã Duyệt',".$result_89['diem_89']."],";
                 echo "['Chưa Duyệt',".$result_67['diem_67']."],";
               
          ?>
        ]);
        var options = {
          title: 'Biểu Đồ Tình Trạng Bài Post Của User',
          is3D:true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<br/>
   <div class = "uk-container">
    <h1 class="uk-heading-divider">Thống Kê</h1>
        <div class="uk-card uk-card-default uk-card-body">
            <div id = "piechart"></div>
        </div>
    </div>
    <br/>
    <?php
        $user = mysqli_query($conn,"select count(*) as user from users ");
        $resultUser = mysqli_fetch_array($user);

        $blog = mysqli_query($conn,"select count(*) as blog from blog ");
        $resultBlog = mysqli_fetch_array($blog);

        $countView = mysqli_query($conn,"select sum(countview) as view from post ");
        $resultCountView = mysqli_fetch_array($countView);
    ?>
   <div class = "uk-container">
        <div class="uk-column-1-3 uk-column-divider">
            <div class="uk-card uk-card-default uk-card-body shadow">
                <div class="uk-card-badge"><span uk-icon="users"></span></div>
                <h3 class="uk-card-title">Tổng Số Users</h3>
                <p> Tổng số Users hiện tại của hệ thống là : <b><?=$resultUser['user']?></b></p>
            </div>

            <div class="uk-card uk-card-default uk-card-body shadow">
                <div class="uk-card-badge"><span uk-icon="reply"></span></div>
                <h3 class="uk-card-title">Tổng Số Bài Post</h3>
                <p> Tổng số bài Post hiện tại của hệ thống là : <b><?=$result_10['diem_10']?></b></p>
            </div>

            <div class="uk-card uk-card-default uk-card-body shadow">
                <div class="uk-card-badge"><span uk-icon="world"></span></div>
                <h3 class="uk-card-title">Tổng Số Bài Blog</h3>
                <p> Tổng số bài Blog hiện tại của hệ thống là : <b><?=$resultBlog['blog']?></b></p>
            </div>
         </div>
         <br/>
         <br/>
        

            <div class="uk-card uk-card-default uk-card-body shadow">
                <div class="uk-card-badge"><span uk-icon="tripadvisor"></span></div>
                <h3 class="uk-card-title">Tổng Số Lược View</h3>
                <p> Tổng số Lược view hiện tại của hệ thống là : <b><?=$resultCountView['view']?></b></p>
            </div>
        
       

         <br/>
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