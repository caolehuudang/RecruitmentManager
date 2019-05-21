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
    <div class="uk-card uk-card-default uk-card-body">
    <?php
        $id = $_SESSION['id_user'];
        $sql = mysqli_query($conn,"select  * from users where id_user = '$id'");
        while ($result = mysqli_fetch_array($sql)) {
        ?>
  
        <h3 class="uk-card-title">Thông Tin User</h3>
        <p>Username: <?= $result['username'] ?></p>
        <p>Password: ******</p>
        <p>Fullname: <?= $result['fullname'] ?> </p>
        <p>Email: <?= $result['email'] ?></p>
        <a href = "./EditUser.php?id_user=<?= $result['id_user'] ?>">Chỉnh sửa thông tin cá nhân</a>
        <?php 
    }
     ?>
    </div>
</div>
<br/>

<div class = "uk-container">
<h4 class ="uk-text-success">Danh Sách Tuyển Dụng</h4>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Title</th>
            <th>COMPANY</th>
            <th>Location</th>
            <th>Status</th>
            <th>CONFIRM</th>
            <th>Action</th>
            <th>result</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $id = $_SESSION['id_user'];
        $sql_post = mysqli_query($conn,"select  * from post where id_user = '$id'");
        $count = 0;
        while ($result = mysqli_fetch_array($sql_post)) {
            $count++;
        ?>
        <tr>
            <td> <?= $count ?> </td>
            <td><?= $result['title'] ?></td>
            <td><?= $result['name_company'] ?></td>
            <td><?= $result['location'] ?></td>
            <td>
                <?php 
                    if($result['status'] == 'T'){
                        echo 'Đang Tuyển';
                    }else{
                        echo 'Đã Xóa';
                    } 
                ?>
            </td>
            <td>
                <?php 
                    if($result['confirm'] == 'T'){
                        echo 'Đã Duyệt';
                    }else{
                        echo 'Chờ Duyệt';
                    } 
                ?>
            </td>
            <td>
                <a class="uk-button uk-button-default" href="./EditRecruitment.php?id_post=<?= $result['id_post'] ?>">Edit</a>
            </td>
            <td>
                <a class="uk-button uk-button-link" href="./CV.php?id_post=<?= $result['id_post'] ?>">List CV</a>
            </td>
        </tr>
        <?php
     }
      ?>
       
    </tbody>
</table>
</div>
<br/>

<div class = "uk-container">
<a class="uk-button uk-button-default" href="#modal-sections" uk-toggle>Tuyển Dụng</a>

<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Tuyển Dụng</h2>
        </div>
        <div class="uk-modal-body">
        <form class="uk-form-stacked" method = "POST" action = "" enctype="multipart/form-data">
            <div class="uk-margin">
                <label class="uk-form-label" for="name_company">Tên Công Ty:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="name_company" name = "name_company" type="text" />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="title">Tiêu Đề:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="title" name = "title" type="text" />
                </div>
            </div>
            <div class="uk-margin">
            <label class="uk-form-label" for="description">Mô Tả:</label>
                <div class="uk-form-controls">
                 <textarea class="uk-textarea" id="description" name = "description" rows="5" placeholder="Mô Tả ..."></textarea>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="quatity">Số Lượng:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="quatity" name = "quatity" type="text" />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="salary">Lương Khởi Điểm:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="salary" name = "salary" type="text" />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="image">Hình Ảnh:</label>
              
                    <input type="file" multiple name = "image" id = "image"> 
                   
               
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="location">Location:</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="location" name = "location">
                        <option value = "HN">Hà Nội</option>
                        <option value = "HCM">Hồ Chí Minh</option>
                    </select>
                </div>
            </div>
            <input type = "hidden" name = "id_user" value = "<?php echo $_SESSION['id_user']; ?>" />
            <div class="uk-margin">
                <div class="uk-modal-footer uk-text-right">
                    <input class="uk-button uk-button-primary uk-text-right" name = "save" type="submit" value = "Save" />
                </div>
            </div>
            <div id="fail-message-alert" class="alert alert-danger"
                style="border-radius:10px;max-width: 500px; margin: auto; text-align: center;margin-bottom: 3%;display:none">
            <span id="fail-message"></span>
            </div>
        </form>
        </div>
        
    </div>
</div>
</div>
<br/>
<?php require_once ('./Footer.php'); ?>

<script type="text/javascript">
        $(document).ready(function() {
            $('nav').addClass('black');
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
               
            });
        });
</script>
<?php
if(isset($_POST["save"])) {



$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



    $name_company = $_POST['name_company'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $quatity = $_POST['quatity'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $id_user = $_POST['id_user'];
    $status = 'T';
    $confirm = 'F';

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $image = $_FILES["image"]["name"]; 
         $sql = "INSERT INTO post(name_company,title,description,salary,quatity,image,status,confirm,location,id_user) VALUES
          ('$name_company','$title','$description','$salary','$quatity','$image','$status','$confirm','$location','$id_user')";
        mysqli_query($conn, $sql);
        move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    ?>
    <script>
          window.location = "Profile.php"
       </script>
    <?php 

//header('Location:Profile.php?id_user='.$id_user);
}
?>

</body>
</html>

<?php
}
?>
