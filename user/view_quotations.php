<?php
session_start();
include('../config/db.php');
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$uid = $_SESSION['user_id'];
$res = $conn->query("SELECT q.*, p.note FROM quotations q JOIN prescriptions p ON q.prescription_id=p.id WHERE p.user_id='$uid'");
while($row = $res->fetch_assoc()){
    echo "<div style='border:1px solid #ccc;padding:10px;margin:10px;'>";
    echo "<b>Prescription:</b> ".$row['note']."<br>";
    echo "<b>Details:</b> ".$row['details']."<br>";
    echo "<b>Total:</b> ".$row['total']."<br>";
    echo "<b>Status:</b> ".$row['status']."<br>";
    if($row['status']=='pending'){
        echo "<a href='quotation_action.php?qid=".$row['id']."&act=accept'>Accept</a> | ";
        echo "<a href='quotation_action.php?qid=".$row['id']."&act=reject'>Reject</a>";
    }
    echo "</div>";
}
?>