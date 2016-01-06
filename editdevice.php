<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id=$_POST['editid'];
$deviceid=mysqli_real_escape_string($con,$_POST['editdeviceid']);
$carid=mysqli_real_escape_string($con,$_POST['editcarid']);
$drivername=mysqli_real_escape_string($con,$_POST['editdriver']);
$info=addslashes(mysqli_real_escape_string($con,$_POST['editinfo']));
$campaignid=mysqli_real_escape_string($con,$_POST['editcampaignid']);
$sql="UPDATE device SET carid='$carid', drivername = '$drivername', deviceid='$deviceid', info='$info' 
WHERE id = $id AND campaignid = $campaignid";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}


if (is_uploaded_file($_FILES['editfront']['tmp_name'])) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["editfront"]["name"]);
$extension = end($temp);

if ((($_FILES["editfront"]["type"] == "image/gif")
|| ($_FILES["editfront"]["type"] == "image/jpeg")
|| ($_FILES["editfront"]["type"] == "image/jpg")
|| ($_FILES["editfront"]["type"] == "image/pjpeg")
|| ($_FILES["editfront"]["type"] == "image/x-png")
|| ($_FILES["editfront"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["front"]["error"] > 0) {
    echo "Return Code: " . $_FILES["editfront"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["editfront"]["name"])) {
       move_uploaded_file($_FILES["editfront"]["tmp_name"],
      "upload/" . $_FILES["editfront"]["name"]);
  	 $front = "upload/" . $_FILES["editfront"]["name"];
    } else {
      move_uploaded_file($_FILES["editfront"]["tmp_name"],
      "upload/" . $_FILES["editfront"]["name"]);
  	 $front = "upload/" . $_FILES["editfront"]["name"];
    }
  }
} else {
  echo "Invalid file";
}
$sql="UPDATE device SET front='$front' 
WHERE id = '$id'AND campaignid = '$campaignid'";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

}


if (is_uploaded_file($_FILES['editback']['tmp_name'])) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["editback"]["name"]);
$extension = end($temp);

if ((($_FILES["editback"]["type"] == "image/gif")
|| ($_FILES["editback"]["type"] == "image/jpeg")
|| ($_FILES["editback"]["type"] == "image/jpg")
|| ($_FILES["editback"]["type"] == "image/pjpeg")
|| ($_FILES["editback"]["type"] == "image/x-png")
|| ($_FILES["editback"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["editback"]["error"] > 0) {
    echo "Return Code: " . $_FILES["editback"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["editback"]["name"])) {
       move_uploaded_file($_FILES["editback"]["tmp_name"],
      "upload/" . $_FILES["editback"]["name"]);
  	 $back = "upload/" . $_FILES["editback"]["name"];
    } else {
      move_uploaded_file($_FILES["editback"]["tmp_name"],
      "upload/" . $_FILES["editback"]["name"]);
  	 $back = "upload/" . $_FILES["editback"]["name"];
    }
  }
} else {
  echo "Invalid file";
}
$sql="UPDATE device SET back='$back' 
WHERE id = '$id'AND campaignid = '$campaignid'";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
}

if (is_uploaded_file($_FILES['editleft']['tmp_name'])) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["editleft"]["name"]);
$extension = end($temp);

if ((($_FILES["editleft"]["type"] == "image/gif")
|| ($_FILES["editleft"]["type"] == "image/jpeg")
|| ($_FILES["editleft"]["type"] == "image/jpg")
|| ($_FILES["editleft"]["type"] == "image/pjpeg")
|| ($_FILES["editleft"]["type"] == "image/x-png")
|| ($_FILES["editleft"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["editleft"]["error"] > 0) {
    echo "Return Code: " . $_FILES["editleft"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["editleft"]["name"])) {
       move_uploaded_file($_FILES["editleft"]["tmp_name"],
      "upload/" . $_FILES["editleft"]["name"]);
  	 $left = "upload/" . $_FILES["editleft"]["name"];
    } else {
      move_uploaded_file($_FILES["editleft"]["tmp_name"],
      "upload/" . $_FILES["editleft"]["name"]);
  	 $left = "upload/" . $_FILES["editleft"]["name"];
    }
  }
} else {
  echo "Invalid file";
}
$sql="UPDATE device SET leftpic='$left' 
WHERE id = '$id'AND campaignid = '$campaignid'";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
}

if (is_uploaded_file($_FILES['editright']['tmp_name'])) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["editright"]["name"]);
$extension = end($temp);

if ((($_FILES["editright"]["type"] == "image/gif")
|| ($_FILES["editright"]["type"] == "image/jpeg")
|| ($_FILES["editright"]["type"] == "image/jpg")
|| ($_FILES["editright"]["type"] == "image/pjpeg")
|| ($_FILES["editright"]["type"] == "image/x-png")
|| ($_FILES["editright"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["editright"]["error"] > 0) {
    echo "Return Code: " . $_FILES["editright"]["error"] . "<br>";
  } else {
     if (file_exists("upload/" . $_FILES["editright"]["name"])) {
       move_uploaded_file($_FILES["editright"]["tmp_name"],
      "upload/" . $_FILES["editright"]["name"]);
  	 $right = "upload/" . $_FILES["editright"]["name"];
    } else {
      move_uploaded_file($_FILES["editright"]["tmp_name"],
      "upload/" . $_FILES["editright"]["name"]);
  	 $right = "upload/" . $_FILES["editright"]["name"];
    }
  }
} else {
  echo "Invalid file";
}
$sql="UPDATE device SET rightpic='$right' 
WHERE id = '$id'AND campaignid = '$campaignid'";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
}



echo "succeed";



?>