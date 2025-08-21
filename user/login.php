<?php
session_start();
include('../config/db.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        if($row['role'] == 'pharmacy'){
            header("Location: ../pharmacy/dashboard.php");
        } else {
            header("Location: upload_prescription.php");
        }
    } else {
        echo "Invalid login";
    }
}
?>
<form method="post">
Email: <input type="email" name="email" required><br>
Password: <input type="password" name="password" required><br>
<input type="submit" name="login" value="Login">
</form>