<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$deviceid=mysqli_real_escape_string($con,$_POST['deviceid']);
$carid=mysqli_real_escape_string($con,$_POST['carid']);
$driver = mysqli_real_escape_string($con,$_POST['driver']);
$info=addslashes(mysqli_real_escape_string($con,$_POST['info']));
$campaignid=mysqli_real_escape_string($con,$_POST['campaignid']);

$allowedExts = array("gif", "jpeg", "jpg", "png");
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
 // echo "Invalid file";
}

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
 // echo "Invalid file";
}



$sql="INSERT INTO device (deviceid,carid,drivername,campaignid,info,front,back,leftpic,rightpic)
VALUES ('$deviceid','$carid','$driver','$campaignid', '$info','$front','$back','$left','$right')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

echo "succeed";



?>