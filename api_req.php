<?php 

 $Array = $_POST['GET'];
 $L_Long = $Array['long'];
 $L_Latitude = $Array['lat'];
 $con = mysqli_connect("ADDRESS","USER","PASS","BBS");  

  $sql = mysqli_query($con,"SELECT * FROM posts");


while($row = mysqli_fetch_array($sql))
{
 $Longitude  = $row['long'];
 $lat = $row['lat'];
 
 echo  "Work_Distance($L_Latitude, $lat,$L_Long,$longitude)";
 
}

function Work_Distance($lat1,$lat2,$lon1,$lon2)
{
 $R = 6371000;
  $Tlong = conv_long($lon2) - conv_long($lon1);
  $Tlat = conv_lat($lat2) - conv_lat($lat1);
  $lat1 = conv_lat($lat1);
  $lat2 = conv_lat($lat2);
  $lon1 = conv_lat($lon1);
  $lon2 = conv_lat($lon2);

  $a = sin($Tlat/2) * sin($Tlat/2) * cos($lat1) * cos($lat2) * sin($Tlong/2) * sin($Tlong/2);
   

 $C = 2 * atan2(sqrt($a), sqrt(1-$a));

 return $d = $R * $C;
 

}

function conv_Lat($lat)
{
 return deg2rad($lat);

}

function conv_long($lon)
{
 return deg2rad($lon);
}

?>
