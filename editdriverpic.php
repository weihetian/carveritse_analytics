<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];

$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
$temp = explode(".", $_FILES["driverpic"]["name"]);
$extension = end($temp);

if ((($_FILES["driverpic"]["type"] == "image/gif")
|| ($_FILES["driverpic"]["type"] == "image/jpeg")
|| ($_FILES["driverpic"]["type"] == "image/jpg")
|| ($_FILES["driverpic"]["type"] == "image/pjpeg")
|| ($_FILES["driverpic"]["type"] == "image/x-png")
|| ($_FILES["driverpic"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["driverpic"]["error"] > 0) {
    echo "Return Code: " . $_FILES["driverpic"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["driverpic"]["name"])) {
       move_uploaded_file($_FILES["driverpic"]["tmp_name"],
      "upload/" . $_FILES["driverpic"]["name"]);
  	 $driverpic = "upload/" . $_FILES["driverpic"]["name"];
    } else {
      move_uploaded_file($_FILES["driverpic"]["tmp_name"],
      "upload/" . $_FILES["driverpic"]["name"]);
  	 $driverpic = "upload/" . $_FILES["driverpic"]["name"];
    }
  }
} else {
  //echo "Invalid file";
}

$sql="UPDATE device
SET driverpic='$driverpic'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo $driverpic;


?>