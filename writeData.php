<?php
require("library.php");
$data=array();
$str=$_POST["emailfield"];
$c=0;
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$pass = $_POST['newPassword'];
$country = $_POST['u_country'];
$gender = $_POST['gender'];
$birthday = $_POST['year']."-".$_POST["month"]."-".$_POST["day"];
$status = "verified";
$posts = "no";
$username = $_POST["userName"];

 
if($gender == "male")
	$profile_pic = "boy.png";
else if($gender == "female")
	$profile_pic = "girl.png";

 if(strlen($_POST["firstName"])>0 &&strlen($_POST["lastName"])>0 &&strlen($_POST["userName"])>0 &&strlen($_POST["emailfield"])>5 && strlen($_POST["phone"])>10 &&strlen($_POST["newPassword"])>7)
 {
	if($_POST["newPassword"]==$_POST["cnfirmPassword"]&& strpos($str,"@") && strpos($str,".")&& $_POST["day"]!="day" &&  $_POST["month"]!="month" &&$_POST["year"]!="year"&&isset($_POST["gender"])){
	//writeToFile();
	$name=$_POST["firstName"]." ".$_POST["lastName"];
	$p=$_POST["phone"];
	//$sql="insert into userinfo values(null,'".$name."','".$_POST["userName"]."','".$_POST["emailfield"]."','".$_POST["phone"]."','".md5($_POST["newPassword"])."','".$_POST["gender"]."','".$_POST["year"]."/".$_POST["month"]."/".$_POST["day"]."')";
	$insert = "insert into users (f_name,l_name,user_name,describe_user,Relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,recovery_account)
		values('$first_name','$last_name','$username','This is my default status!','...','$pass','$str','$country','$gender','$birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts','I want to put adding intheuniverse.')";
		
	//echo $sql;
	$r=updateSQL($insert);
	echo $r;
	if($r==1){
		echo '<script>alert("Well Done you are good to go.")</script>';
			echo "<script>window.open('Login.php', '_self')</script>";
			}
	else {
		echo "<script>alert('Registration failed, please try again!')</script>";
		echo "<script>window.open('Login.php', '_self')</script>";}
	} 
	else {
		echo "<script>alert('Invalid Format!')</script>";
		echo "<script>window.open('Login.php', '_self')</script>";
		}
 } 
 else {
	 echo "<script>alert('Please fill eachfield correctly!')</script>";
		echo "<script>window.open('Login.php', '_self')</script>";
		}


?>