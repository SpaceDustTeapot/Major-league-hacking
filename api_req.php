<?php 

header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
 
 $Array = $_GET;
 $L_Long = $Array['long'];
 $L_Latitude = $Array['lat'];
 $Seshid = $Array['sesh'];
 $Latarray = array();
 $Longarray = array();
 $con = mysqli_connect("127.0.0.1","MLH","ebin","MLH");  
 $distarray = array();
  $sql = mysqli_query($con,"SELECT * FROM pottylist");

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<potty>";

$i=0;
while($row = mysqli_fetch_array($sql))
{/*
	if($i<10)
	{
 $Longitude  = $row['lon'];
 $lat = $row['lat'];
 echo "<lat>" . $lat . "</lat>";
 echo "<long>". $Longitude . "</long>";
 temp = Work_Distance($L_Latitude, $lat,$L_Long,$Longitude);
 echo "<Distance>" . $temp . "</Distance>";
	}
 $i++;*/
  $temp = Work_Distance($L_Latitude, $lat,$L_Long,$Longitude);
//Everything above line works
   $Latarray[$i] = $row['lat'];
   $Longarray[$i] = $row['lon'];
   $distarray[$i] = $temp;
  $i++;
}

Print_nearest_ten($distarray,$Latarray,$Longarray,$i);
 


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

function Print_nearest_ten($distarr,$latarr,$lonarr,$i)
{

 $low;
 $place;
 $count = 0;
 $lowloop = false;
 if($count <= 15)
{
 $lowloop = true;
}
while($count < 15 && $lowloop == true || $count<$i && lowloop == false)
{
 	for($k =0;$k<=$i;$k++)
	{
 		$test = $distarr[$k];
 		if($test < $distarr[$k])
 		{
 	 		$low = $test;
			$place = $k;

 		}
		else 
		{

		}

	}
  echo "<lat>" . $latarr[$k] . "</lat>";
 echo "<long>". $lonarr[$k] . "</long>";
 echo "<Distance>" . $distarr[$k] . "</Distance>";
 $distarr[$k] = 90000000000000000;
 $count++;
 
}
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
