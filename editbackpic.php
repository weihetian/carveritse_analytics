<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];

$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
$temp = explode(".", $_FILES["back"]["name"]);
$extension = end($temp);

if ((($_FILES["back"]["type"] == "image/gif")
|| ($_FILES["back"]["type"] == "image/jpeg")
|| ($_FILES["back"]["type"] == "image/jpg")
|| ($_FILES["back"]["type"] == "image/pjpeg")
|| ($_FILES["back"]["type"] == "image/x-png")
|| ($_FILES["back"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["back"]["error"] > 0) {
    echo "Return Code: " . $_FILES["back"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["back"]["name"])) {
       move_uploaded_file($_FILES["back"]["tmp_name"],
      "upload/" . $_FILES["back"]["name"]);
  	 $back = "upload/" . $_FILES["back"]["name"];
    } else {
      move_uploaded_file($_FILES["back"]["tmp_name"],
      "upload/" . $_FILES["back"]["name"]);
  	 $back = "upload/" . $_FILES["back"]["name"];
    }
  }
} else {
  //echo "Invalid file";
}

$sql="UPDATE device
SET back='$back'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo $back;


?>