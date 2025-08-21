<?php
session_start();
include('../config/db.php');
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit; }

if(isset($_POST['upload'])){
    $note = $_POST['note'];
    $delivery_address = $_POST['delivery_address'];
    $delivery_time = $_POST['delivery_time'];
    $user_id = $_SESSION['user_id'];

    $images = [];
    for($i=1; $i<=5; $i++){
        if(isset($_FILES['image'.$i]) && $_FILES['image'.$i]['name'] != ""){
            $filename = time()."_".$_FILES['image'.$i]['name'];
            move_uploaded_file($_FILES['image'.$i]['tmp_name'], "../uploads/".$filename);
            $images[$i] = $filename;
        } else {
            $images[$i] = NULL;
        }
    }

    $sql = "INSERT INTO prescriptions (user_id,note,delivery_address,delivery_time,image1,image2,image3,image4,image5) 
            VALUES ('$user_id','$note','$delivery_address','$delivery_time','".$images[1]."','".$images[2]."','".$images[3]."','".$images[4]."','".$images[5]."')";
    if($conn->query($sql)){
        echo "Prescription uploaded successfully";
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<form method="post" enctype="multipart/form-data">
Note: <textarea name="note"></textarea><br>
Delivery Address: <input type="text" name="delivery_address" required><br>
Delivery Time: 
<select name="delivery_time">
  <option>08:00 - 10:00</option>
  <option>10:00 - 12:00</option>
  <option>12:00 - 14:00</option>
  <option>14:00 - 16:00</option>
  <option>16:00 - 18:00</option>
</select><br>
Upload up to 5 images:<br>
<?php for($i=1;$i<=5;$i++){ echo "Image $i: <input type='file' name='image$i'><br>"; } ?>
<input type="submit" name="upload" value="Upload">
</form>