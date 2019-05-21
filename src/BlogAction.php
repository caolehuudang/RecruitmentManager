<?php 
require_once('../Config/db.php');

if (isset($_POST["submit"])) {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $id_user = $_POST['id_user'];
        $sql = "INSERT INTO blog(title,link,id_user) VALUES ('$title','$link','$id_user')";
        mysqli_query($conn,$sql);
        ?>
            <script>
                window.alert("Đăng bài Thành Công");
                window.location="Blog.php";
            </script>
        <?php
}else {
    echo 'not';
}

mysqli_close($conn);
?>