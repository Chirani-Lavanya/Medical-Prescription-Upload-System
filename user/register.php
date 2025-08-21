<?php
include('../config/db.php');
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO users (name,email,address,contact,dob,password,role) VALUES ('$name','$email','$address','$contact','$dob','$password','user')";
    if($conn->query($sql)){
        echo "Registered successfully <a href='login.php'>Login</a>";
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<form method="post">
Name: <input type="text" name="name" required><br>
Email: <input type="email" name="email" required><br>
Address: <input type="text" name="address" required><br>
Contact: <input type="text" name="contact" required><br>
DOB: <input type="date" name="dob" required><br>
Password: <input type="password" name="password" required><br>
<input type="submit" name="register" value="Register">
</form>