<?php
var_dump($_POST);
//code stolen from W3Schools.com php upload :^)
var_dump($_FILES);

$conn = mysqli_connect('127.0.0.1','MLH','ebin','MLH');
$cat = $_POST['Cate'];
$nam = $_POST['Name'];



$filesize = 0;
$mode =0;
$target_dir = "uploads/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$Filetype = pathinfo($target_file,PATHINFO_EXTENSION);
//print_varibles();

if(file_exists($target_file))
{
 echo"File exists<br>";
 echo "Sorry, file already exists";
 $uploadOk = 0;

}

$size = $_FILES["fileToUpload"]["size"] / 1024000;

/*
if($_FILES["fileToUpload"]["size"] > 500000)
{
 echo "Sorry, Your file is too large.";
 $uploadOk = 0;

}*/

/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
{
 echo "Sorry, wrong format";
 $uploadOk = 0;
} */


if ($Filetype != "jpg" || $Filetype != "png" || $Filetype != "gif")
{
 echo"<br>";
 echo $Filetype;
 echo "<br>";
 echo "not a image file";
 $uploadOk = 0;
}

if($uploadOk == 0)
{
 echo "Sorry, your file was not uploaded";

}
else
{
 	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
	{
	  echo "File Uploaded";
	 $uflag = uload_to_database($conn,$cat,$target_file,$nam,$size);
	}
	else
	{
	echo "There was a issue";
	}
}

//print_varibles();

//function print_varibles()
//{
 /*echo"Filesize:<br>";
 echo $filesize;
echo "<br>mode;<br>";
echo $mode;
echo "<br>Target<br>";
echo $target_dir;
echo "<br>Target_file<br>";
echo $target_file;
echo "<br>UploadOk<br>";
echo $uploadOk;
echo "<br>filetype<br>";
echo $Filetype; */

//}

//Upload to database
sort_database($conn);



function uload_to_database($connection,$cate,$tgdir,$name,$SIZE)
{
 $sql = "SELECT * FROM Image";
 $result = mysqli_query($connection,$sql);
 while($row = mysqli_fetch_array($result))
{
  if($row['name'] == $name )
  {
    return false;
  }
}   
echo "<br>";
echo $name;
$dayte = get_date(); 
$sql = "INSERT into Image(catagory,name,date_added,size,download_link)values('$cate','$name','$dayte','$SIZE','$tgdir')";
mysqli_query($connection,$sql);


}

function get_date()
{
 return date("d m Y");
}

function sort_database($connection)
{
//organise the IDs
 $sql = "SELECT * FROM Image";
 $result = mysqli_query($connection,$sql);
 $Num = 1;

 while($row = mysqli_fetch_array($result))
 {
  if($row['id'] == $Num)
  {
     $Num = $Num + 1;
  }
  else
  {
    $currID = $row['id'];
    $sql = "UPDATE Image SET id=$Num WHERE id=$currID";
    mysqli_query($connection,$sql);
    $Num = $Num + 1;
  }
 }
  
}
?>
