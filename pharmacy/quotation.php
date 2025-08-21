<?php
session_start();
include('../config/db.php');
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pharmacy'){ header("Location: ../user/login.php"); exit; }

$pid = $_GET['pid'];
if(isset($_POST['send'])){
    $details = $_POST['details'];
    $total = $_POST['total'];
    $pharmacy_id = $_SESSION['user_id'];
    $sql = "INSERT INTO quotations (prescription_id,pharmacy_id,details,total) VALUES ('$pid','$pharmacy_id','$details','$total')";
    if($conn->query($sql)){
        $conn->query("UPDATE prescriptions SET status='quoted' WHERE id='$pid'");
        echo "Quotation sent!";
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<form method="post">
Details:<br>
<textarea name="details" required></textarea><br>
Total: <input type="text" name="total" required><br>
<input type="submit" name="send" value="Send Quotation">
</form>