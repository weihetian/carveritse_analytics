<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];

$allowedExts = array("gif", "jpeg", "jpg", "png","JPG");
$temp = explode(".", $_FILES["right"]["name"]);
$extension = end($temp);

if ((($_FILES["right"]["type"] == "image/gif")
|| ($_FILES["right"]["type"] == "image/jpeg")
|| ($_FILES["right"]["type"] == "image/jpg")
|| ($_FILES["right"]["type"] == "image/pjpeg")
|| ($_FILES["right"]["type"] == "image/x-png")
|| ($_FILES["right"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["right"]["error"] > 0) {
    echo "Return Code: " . $_FILES["right"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["right"]["name"])) {
       move_uploaded_file($_FILES["right"]["tmp_name"],
      "upload/" . $_FILES["right"]["name"]);
  	 $right = "upload/" . $_FILES["right"]["name"];
    } else {
      move_uploaded_file($_FILES["right"]["tmp_name"],
      "upload/" . $_FILES["right"]["name"]);
  	 $right = "upload/" . $_FILES["right"]["name"];
    }
  }
} else {
  //echo "Invalid file";
}

$sql="UPDATE device
SET rightpic='$right'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo $right;


?>