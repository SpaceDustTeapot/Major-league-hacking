<?php 

header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
 
 $Array = $_GET;
 $L_Long = $Array['long'];
 $L_Latitude = $Array['lat'];
 $Seshid = $Array['sesh'];
 $con = mysqli_connect("127.0.0.1","MLH","ebin","MLH");  

  $sql = mysqli_query($con,"SELECT * FROM pottylist");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<potty>";

while($row = mysqli_fetch_array($sql))
{
 $Longitude  = $row['lon'];
 $lat = $row['lat'];
 echo "<lat>" . $lat . "</lat>";
 echo "<long>". $Longitude . "</long>";
 $temp = Work_Distance($L_Latitude, $lat,$L_Long,$Longitude);
 echo "<Distance>" . $temp . "</Distance>";
 
}

echo "</potty>";

function Work_Distance($lat1,$lat2,$lon1,$lon2)
{
// echo "<br>";
 //echo "DEBUG";
// echo "<br>";
// echo "LAT1: ". $lat1 . " LAT2: ". $lat2. " Lon1: ". $lon1 . " Lon2: " . $lon2;
 $R = 6371000;
  $Tlong = conv_long($lon2) - conv_long($lon1);
  $Tlat = conv_lat($lat2) - conv_lat($lat1);
  $lat1 = conv_lat($lat1);
  $lat2 = conv_lat($lat2);
  $lon1 = conv_lat($lon1);
  $lon2 = conv_lat($lon2);

 //echo "<br>";
 //echo "Tlong: ". $Tlong. " Tlat: " . $Tlat . " lat1: " . $lat1. " lat2: " . $lat2 . " lon1: " . $lon1 . " lon2: " . $lon2;

  $a = sin($Tlat/2) * sin($Tlat/2) * cos($lat1) * cos($lat2) * sin($Tlong/2) * sin($Tlong/2);
  // echo "<br>" . $a;

 $C = 2 * atan2(sqrt($a), sqrt(1-$a));
 //echo "<br>";
// echo $C;
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
