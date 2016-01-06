
<?php


$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
$date=date('Y-m-d', strtotime("07/21/2014"));
  
  $theresult=array();
  
  $result = mysqli_query($con,"SELECT * FROM miles_report WHERE date ='$date'")or die("Error: ".mysqli_error($con));

 while($row = mysqli_fetch_array($result)) {
 		$city = $row['city'];
 		$mile = $row['mile'];
 		$theresult[$city]+=$mile;				
 }
 arsort($theresult);
//  
//  foreach( $theresult as $key => $obj)
// {
// //echo $theresult;
// 
//   echo $key;
//  echo $obj;
// }
 echo json_encode($theresult);
 $finalresult = array();

// function searchArray($array, $key, $val) {
//     foreach ($array as $item){
//     
//         if (isset($item['city']) && $item['city'] == $key)
//         {
//         echo  $item['mile'];
//         $item['mile'] = $item['mile']+ $val;
//         echo  "---------";
//         echo  $item['mile'];
//         echo  "|||||||||||||";
//             return true;}}
//     return false;
//     }
// 
// foreach( $theresult as $key => $val)
// {
//   if (array_key_exists($key, $finalresult))
//   {
//   echo "---------";
// //  $finalresult [$key] = $finalresult[$key]+ $val;
//   }else
//   {
//  
//   $finalresult[$key] = $finalresult[$key]+$val;
//    echo "||||||".$key."|||||";
//   }}
//     //echo $key;
//     //echo " ";
//   //  echo $obj["city"];
//    // echo $obj["mile"];
// //    if(searchArray($finalresult,$obj["city"],$obj["mile"])){
// //    
// //    }else{
// //         $finalresult[]=array("city" => $obj["city"],"mile"=>$obj["mile"]);
// //         }
// // }
//  foreach( $finalresult as $key => $obj)
// {
// //echo $theresult;
// 
//   echo $key;
//  echo $obj;
// }

// foreach( $finalresult as $key => $obj)
// {
// //echo $theresult;
//   echo $obj["city"];
//  echo $obj["mile"];
// }
?>