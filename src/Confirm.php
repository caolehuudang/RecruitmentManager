
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
</head>
<body>
<?php require_once ('./NavBarAdmin.php'); ?>
<div class="uk-container" >
<br/>
    <h2 class="uk-heading-divider">Duyệt Bài</h2>
    <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
<?php
    $id_post = $_GET['id_post'];
    $id_user = $_GET['id_user'];
    $sql = mysqli_query($conn,"select * from post where id_post = '$id_post'");
    while ($result = mysqli_fetch_array($sql)) {
?>
 <form class="uk-form-stacked" method = "POST" action = "" uk-scrollspy="cls: uk-animation-slide-left; repeat: true" >
            <div class="uk-margin">
                <label class="uk-form-label" for="name_company">Company:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="name_company" name = "name_company" type="text" value = "<?= $result ['name_company']?>" disabled>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="title">Title:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="title" name = "title" type="text" value = "<?= $result ['title']?>" disabled>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="description">Description:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="description" name = "description" type="text" value = "<?= $result ['description']?>" disabled>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="salary">Salary: </label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="salary" name = "salary" type="text" value = "<?= $result ['salary']?> đ" disabled>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="quatity">Quatity: </label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="quatity" name = "quatity" type="text" value = "<?= $result ['quatity']?>" disabled>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="location">Location: </label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="location" name = "location" type="text" value = "<?= $result ['location']?>" disabled>
                </div>
            </div>
           
            <div class="uk-margin">
                <input class="uk-button uk-button-primary uk-text-right" name = "save" type="submit" value = "Confirm" />
            </div>
            <br/><br/>
        </form>
  
        <div class="uk-child-width-1-2 uk-text-center" uk-grid>
            <div>
                <div class="uk-child-width-1-2 uk-text-center" uk-grid>
                    <div>
                        <div ></div>
                    </div>
                    <div>
                        <img src = "../images/<?= $result['image'] ?>" />
                    </div>
                </div>
            </div>
        </div>
      
    <?php 
        }
     ?>
      </div>
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

<?php
$sqlSendMail = mysqli_query($conn,"select * from users WHERE  id_user = '$id_user'");
$row = mysqli_fetch_array($sqlSendMail);
$email = $row['email'];
$fullname = $row['fullname'];

    if(isset($_POST['save'])){
        $id_post = $_GET['id_post'];
        $update = mysqli_query($conn,"UPDATE post SET confirm = 'T' WHERE id_post = '$id_post'");


    //Send Mail
        			
date_default_timezone_set('Etc/UTC');

require '../sendmail/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "dcop70@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "0906138227";

//Set who the message is to be sent from
$mail->setFrom('dcop70@gmail.com', 'TOP JOBS');

//Set an alternative reply-to address
$mail->addReplyTo('dcop70@gmail.com', 'TOP JOBS');

//Set who the message is to be sent to
$mail->addAddress($email, $name);

//Set the subject line
$mail->Subject = ' TOP JOBS';


$mail->msgHTML('
	<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - GMail SMTP test</title>
</head>
<body>
	<h1>Dear : '. $fullname . '</h1>
	<h1 style="color:lightblue">Welcome to TOP JOBS</h1>
	<img style="width:100px;margin:auto" src="../images/email.jpg" />
    <p>Cám ơn bạn đã chọn Top Jobs để đăng tin</p>
    <p>Bài đăng của bạn đả được duyệt</p>
    <p>Chúc bạn tìm được ứng cử viên phù hợp</p>
	<p>Chúc bạn có ngày làm việc vui vẻ</p>
	<p>Best !</p>
</body>
</html>

');

	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		console.log($mail->ErrorInfo);
	} else {
		echo "Message sent!";
	}			
    
    // End Send Mail

        ?>
        <script>
            window.location = "ViewConfirm.php"
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