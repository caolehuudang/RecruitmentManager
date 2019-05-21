<?php
   if(!isset($_SESSION)) 
   { 
       session_start(); 
   } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tuyển Dụng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <section>
            <nav class= "navBarHome">
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <header class="logo">
                    TopJobs
                </header>
                <div class="menu">
                    <ul>
                        <li><a class="cool-link" href="./Home.php">HOME</a></li>
                        <li><a class="cool-link" href="./AllJobs.php">ALL JOBS</a></li>
                        <li><a class="cool-link" href="./BlogUser.php">BLOG</a></li>
                        <li><a class="cool-link" href="./Contact.php">CONTACT</a></li>
                        <?php
                            if (isset($_SESSION['username']))
                            {
                                if($_SESSION['role'] == 'ADMIN'){
                                    echo "<li><a class='cool-link' href='./Admin.php'>ADMIN</a></li>";
                                    echo "<li><a class='cool-link' href='./Logout.php'>LOGOUT</a></li>";
                                }else{
                                    echo "<li><a class='cool-link' href='./Profile.php'>PROFILE</a></li>";
                                    echo "<li><a class='cool-link' href='./Logout.php'>LOGOUT</a></li>";
                                }
                            }
                            else{
                                echo "<li><a class='cool-link' href='./Login.php'>LOGIN</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </nav>
                      
        </section>
    </div>

</body>
</html>
