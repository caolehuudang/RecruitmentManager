<?php
require_once('../Config/db.php');
    $id_post = $_POST['id_post'];
    
    $sql = mysqli_query($conn,"select countview from post where id_post = '$id_post'");
      while ($result = mysqli_fetch_array($sql)) {
            $count = $result['countview'] + 1;
            $update = mysqli_query($conn,"UPDATE post SET countview = '$count' WHERE id_post = '$id_post'");
      }
?>