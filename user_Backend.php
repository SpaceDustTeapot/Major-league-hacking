<?php
var_dump($_POST);
$Array = $_POST;
$Username = $Array['Username'];
$Password = $Array['Password'];
$con = mysqli_connect("127.0.0.1","MLH","ebin","MLH");  

 $rez = Check_Database($con,$Username,$Password);

 if($rez == false)
	{
	Add_Users($con,$Username,$Password);	  


	}
	else
	{
	 echo "Password/username in use";
	}

 

/*
Check Database for entrys of the same name and password
*/

function Check_Database($CONN,$username,$password)
{
 $sql = mysqli_query($con,"SELECT * FROM USERS");
 while($result = mysqli_fetch_array($sql))
	{
		if($username == $result['usernames'])
		{
		  echo "Found user names";
		 return true;
		}
		else if($password == $result['password']
		{
		 echo "Found Password";
		 return true;

		}

	}

	return false;
}

function Add_User($CONN,$username,$password)
{

 //NEED TO SANITISE
//$user, Pass, Admin?
 $add = "INSERT INTO USERS Values('$username', '$password',0) ";
 $result = mysqli_query($con,$add);
 


}

?>

<html>

	<body> </body>
</html>

