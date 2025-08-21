<?php
session_start();
include('../config/db.php');
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pharmacy'){ header("Location: ../user/login.php"); exit; }

$res = $conn->query("SELECT p.*, u.name as uname FROM prescriptions p JOIN users u ON p.user_id=u.id WHERE p.status='pending'");
echo "<h2>Pending Prescriptions</h2>";
while($row = $res->fetch_assoc()){
    echo "<div style='border:1px solid #ccc;padding:10px;margin:10px;'>";
    echo "<b>User:</b> ".$row['uname']."<br>";
    echo "<b>Note:</b> ".$row['note']."<br>";
    echo "<b>Delivery:</b> ".$row['delivery_address']." (".$row['delivery_time'].")<br>";
    for($i=1;$i<=5;$i++){ if($row['image'.$i]) echo "<img src='../uploads/".$row['image'.$i]."' width='100'> "; }
    echo "<br><a href='quotation.php?pid=".$row['id']."'>Prepare Quotation</a>";
    echo "</div>";
}
?>