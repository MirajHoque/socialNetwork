<?php
function LoadFromFile(){
	global $auth;
	$myfile=fopen("Database.txt","r") or die("File Not Found");
	while($line=fgets($myfile)){
		$line=trim($line);
		$cr=explode(" ",$line);
		$auth[]=array("email"=>$cr[3],"pass"=>$cr[5]);
	}
	fclose($myfile);
}
function loadFromMySQL($sql){
	global $auth;
	$conn = mysqli_connect("localhost", "root", "","social_network");
	//echo $sql;
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$auth=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$auth[]=$row;
	}
	//return $arr;
}

function deleteFromMySQL($sql){
	$conn = mysqli_connect("localhost", "root", "","social_network");
	$result = mysqli_query($conn, $sql)or die(mysqli_error());
	mysqli_close($conn);
	return $result;
	
}

function addFriendToDB($own,$other){
	$sql="insert into friends values ('','$own','$other')";
	$conn = mysqli_connect("localhost", "root", "","social_network");
	$result = mysqli_query($conn, $sql)or die(mysqli_error());
	return $result;
}

function updateSQL($sql){
	$conn = mysqli_connect("localhost", "root", "","social_network");
	$result = mysqli_query($conn, $sql)or die(mysqli_error());
	return $result;
}

function writeToFile(){
	 $myfile=fopen('Database.txt','a+') or die ("Unable to find file");
	$c=fwrite($myfile,"\r\n");
	$c+=fwrite($myfile,$_POST["firstName"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["lastName"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["userName"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["email"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["phone"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,md5($_POST["newPassword"]));
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["day"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["month"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["year"]);
	$c+=fwrite($myfile," ");
	$c+=fwrite($myfile,$_POST["gender"]);
	
}
	

?>