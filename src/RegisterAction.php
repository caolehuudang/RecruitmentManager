<?php 
require_once('../Config/db.php');

if (isset($_POST["Register"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullName = $_POST['fullname'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $role = 'USER';
   
    if ($password == $password1){
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
       
    }else {
        ?>
            <script>
                 window.alert("Nhập lại Password không đúng");
                 window.location="Register.php";
            </script>
        <?php
    }
   
    $sql2= mysqli_query($conn,"select * from users WHERE username = '$username'");
    $username_exist=mysqli_num_rows($sql2);

     if($username_exist)
     {
        ?>
        <script>
        window.alert("Username đã tồn tại");
        window.location="Register.php"
        </script>
        <?php
     }else{
        $sql = "INSERT INTO users(username,password,fullname,email,role) VALUES ('$username','$hashed_password','$fullName','$email','$role')";
        mysqli_query($conn,$sql);
        
        ?>
            <script>
                window.alert("Đăng Ký Thành Công");
                window.location="Login.php";
            </script>
        <?php
     }

}else {
    echo 'not';
}

mysqli_close($conn);
?>