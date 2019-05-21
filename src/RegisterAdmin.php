<?php 
require_once('../Config/db.php');

if (isset($_POST["save"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullName = $_POST['fullname'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   
    $sql2= mysqli_query($conn,"select * from users WHERE username = '$username'");
    $username_exist=mysqli_num_rows($sql2);

     if($username_exist)
     {
        ?>
        <script>
        window.alert("Username đã tồn tại");
        window.location="ManagerEmployee.php"
        </script>
        <?php
     }else{
        $sql = "INSERT INTO users(username,password,fullname,email,role) VALUES ('$username','$hashed_password','$fullName','$email','$role')";
        mysqli_query($conn,$sql);
        ?>
            <script>
                window.alert("Đăng Ký Thành Công");
                window.location="ManagerEmployee.php";
            </script>
        <?php
     }

}else {
    echo 'not';
}

mysqli_close($conn);
?>