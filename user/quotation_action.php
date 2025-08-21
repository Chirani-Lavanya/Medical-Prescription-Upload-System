<?php
session_start();
include('../config/db.php');
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

$qid = $_GET['qid'];
$act = $_GET['act'];
$status = ($act=='accept') ? 'accepted' : 'rejected';
$conn->query("UPDATE quotations SET status='$status' WHERE id='$qid'");
echo "You have $status the quotation. <a href='view_quotations.php'>Back</a>";
?>