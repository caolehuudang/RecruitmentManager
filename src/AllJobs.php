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
  <link rel= " shortcut icon" href="../images/logo1.jpg" type="image/ico">
</head>
<body>
<?php require_once ('./NavBar.php'); ?>
<br/><br/><br/><br/>
<div class = "uk-container">
<h2 class="uk-heading-divider">All Jobs</h2>
<br/>

    <div class="uk-child-width-1-4@m uk-grid-small uk-grid-match" uk-grid>
     <?php
        $sql = mysqli_query($conn,"select * from post where status = 'T' and confirm = 'T' ORDER BY id_post desc");
        while ($result = mysqli_fetch_array($sql)) {
            if($result['location'] == 'HN'){
                $result['location'] = 'Hà Nội';
            }else if($result['location'] = 'HCM'){
                $result['location'] = 'Hồ Chí Minh';
            }else{
                echo "";
            }
            ?>
            <div class="uk-card uk-card-default uk-width-1-3@m" style = "margin-bottom:5%" uk-scrollspy="cls: uk-animation-slide-left; repeat: true">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="../images/<?= $result['image'] ?>">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $result["title"] ?></h3>
                            <p class="uk-text-meta uk-margin-remove-top"><span uk-icon="icon: location"> </span><?= $result["location"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p>Yêu Cầu:</p>
                    <p><?= $result["description"] ?></p>
                </div>
                <div class="uk-card-footer">
                    
                    <a id= "count" href = "./JobDetail.php?id_post=<?= $result['id_post'] ?>" class="uk-button uk-button-text">Xem Chi Tiết</a>
                    <span style = "margin-left: 90px">Lượt Xem: <?= $result["countview"] ?> </span>
                </div>
            </div>
<?php
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
