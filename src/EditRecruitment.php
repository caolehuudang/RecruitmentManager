
<?php
session_start();
require_once('../Config/db.php');

if (isset($_SESSION['username']) == false) {
    header('Location: Login.php');
} else {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Employee</title>
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
<div class = "uk-container ">
    <?php 
         $id_post = $_GET['id_post'];
         $sql = mysqli_query($conn,"select * from post where id_post = '$id_post'");
        
            while ($result = mysqli_fetch_array($sql)) {
            ?>
          <form class="uk-form-stacked" method = "POST" action = "" enctype="multipart/form-data">
            <div class="uk-margin">
                <label class="uk-form-label" for="name_company">Tên Công Ty:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="name_company" name = "name_company" type="text" value = "<?= $result['name_company'] ?>" />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="title">Tiêu Đề:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="title" name = "title" type="text" value = "<?= $result['title'] ?>" />
                </div>
            </div>
            <div class="uk-margin">
            <label class="uk-form-label" for="description">Mô Tả:</label>
                <div class="uk-form-controls">
                 <textarea class="uk-textarea" id="description" name = "description" rows="5" value = "<?= $result['description'] ?>" placeholder="<?= $result['description'] ?>"></textarea>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="quatity">Số Lượng:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="quatity" name = "quatity" type="text" value = "<?= $result['quatity'] ?>" />
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="salary">Lương Khởi Điểm:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="salary" name = "salary" type="text" value = "<?= $result['salary'] ?>"  />
                </div>
            </div>
            <!-- <div class="uk-margin">
                <label class="uk-form-label" for="image">Hình Ảnh:</label>
              
                    <input type="file" multiple name = "image" id = "image"> 
            </div> -->
            <div class="uk-margin">
                <label class="uk-form-label" for="location">Location:</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="location" name = "location">
                        <option value = "HN">Hà Nội</option>
                        <option value = "HCM">Hồ Chí Minh</option>
                    </select>
                </div>
            </div>
            <input type = "hidden" name = "id_post" value = "<?= $result['id_post'] ?>" />
            <div class="uk-margin">
                <div class="uk-modal-footer uk-text-right">
                    <input class="uk-button uk-button-primary uk-text-right" name = "save" type="submit" value = "Save" />
                    <input class="uk-button uk-button-danger uk-text-right" name = "delete" type="submit" value = "delete" />
                </div>
            </div>
            <div id="fail-message-alert" class="alert alert-danger"
                style="border-radius:10px;max-width: 500px; margin: auto; text-align: center;margin-bottom: 3%;display:none">
            <span id="fail-message"></span>
            </div>
        </form>
            <?php
            }
    ?>
       
    </div>


<?php
if(isset($_POST['save'])){
    $id_post = $_POST['id_post'];
    $name_company = $_POST['name_company'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $quatity = $_POST['quatity'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
   
    $update = mysqli_query($conn,"UPDATE post SET name_company = '$name_company', title = '$title', 
    description = '$description', quatity = '$quatity', salary = '$salary', location = '$location'
     WHERE id_post = '$id_post'");
    ?>
    <script>
        window.location = "Profile.php?"
     </script>
    <?php
}
else if(isset($_POST['delete'])){
    $status = 'F';
    $id_post = $_POST['id_post'];
    $update = mysqli_query($conn,"UPDATE post SET status = '$status'
     WHERE id_post = '$id_post'");
      ?>
      <script>
          window.location = "Profile.php?"
       </script>
      <?php
}
?>

</body>
</html>
<?php
    }
?>