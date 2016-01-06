<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];

$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
$temp = explode(".", $_FILES["front"]["name"]);
$extension = end($temp);

if ((($_FILES["front"]["type"] == "image/gif")
|| ($_FILES["front"]["type"] == "image/jpeg")
|| ($_FILES["front"]["type"] == "image/jpg")
|| ($_FILES["front"]["type"] == "image/pjpeg")
|| ($_FILES["front"]["type"] == "image/x-png")
|| ($_FILES["front"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["front"]["error"] > 0) {
    echo "Return Code: " . $_FILES["front"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["front"]["name"])) {
       move_uploaded_file($_FILES["front"]["tmp_name"],
      "upload/" . $_FILES["front"]["name"]);
  	 $front = "upload/" . $_FILES["front"]["name"];
    } else {
      move_uploaded_file($_FILES["front"]["tmp_name"],
      "upload/" . $_FILES["front"]["name"]);
  	 $front = "upload/" . $_FILES["front"]["name"];
    }
  }
} else {
  //echo "Invalid file";
}

$sql="UPDATE device
SET front='$front'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo $front;


?>