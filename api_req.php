<?php 
 var_dump($_GET);
 $Array = $_GET;
 $L_Long = $Array['long'];
 $L_Latitude = $Array['lat'];
 $con = mysqli_connect("127.0.0.1","MLH","ebin","MLH");  

  $sql = mysqli_query($con,"SELECT * FROM pottylist");


while($row = mysqli_fetch_array($sql))
{
 $Longitude  = $row['lon'];
 $lat = $row['lat'];
 $temp = Work_Distance($L_Latitude, $lat,$L_Long,$Longitude);
 echo $temp;
 
}

function Work_Distance($lat1,$lat2,$lon1,$lon2)
{
 echo "<br>";
 echo "DEBUG";
 echo "<br>";
 echo "LAT1: ". $lat1 . " LAT2: ". $lat2. " Lon1: ". $lon1 . " Lon2: " . $lon2;
 $R = 6371000;
  $Tlong = conv_long($lon2) - conv_long($lon1);
  $Tlat = conv_lat($lat2) - conv_lat($lat1);
  $lat1 = conv_lat($lat1);
  $lat2 = conv_lat($lat2);
  $lon1 = conv_lat($lon1);
  $lon2 = conv_lat($lon2);

 echo "<br>";
 echo "Tlong: ". $Tlong. " Tlat: " . $Tlat . " lat1: " . $lat1. " lat2: " . $lat2 . " lon1: " . $lon1 . " lon2: " . $lon2;

  $a = sin($Tlat/2) * sin($Tlat/2) * cos($lat1) * cos($lat2) * sin($Tlong/2) * sin($Tlong/2);
   echo "<br>" . $a;

 $C = 2 * atan2(sqrt($a), sqrt(1-$a));
 echo "<br>";
 echo $C;
 return $R * $C;
 

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
