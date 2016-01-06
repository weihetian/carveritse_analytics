<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];

$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
$temp = explode(".", $_FILES["left"]["name"]);
$extension = end($temp);

if ((($_FILES["left"]["type"] == "image/gif")
|| ($_FILES["left"]["type"] == "image/jpeg")
|| ($_FILES["left"]["type"] == "image/jpg")
|| ($_FILES["left"]["type"] == "image/pjpeg")
|| ($_FILES["left"]["type"] == "image/x-png")
|| ($_FILES["left"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["left"]["error"] > 0) {
    echo "Return Code: " . $_FILES["left"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["left"]["name"])) {
       move_uploaded_file($_FILES["left"]["tmp_name"],
      "upload/" . $_FILES["left"]["name"]);
  	 $left = "upload/" . $_FILES["left"]["name"];
    } else {
      move_uploaded_file($_FILES["left"]["tmp_name"],
      "upload/" . $_FILES["left"]["name"]);
  	 $left = "upload/" . $_FILES["left"]["name"];
    }
  }
} else {
  //echo "Invalid file";
}

$sql="UPDATE device
SET leftpic='$left'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo $left;


?>