<!DOCTYPE html>
<html>
<style>
table#mainTable{
background-color:#187FAB;

}
input#textfield{
font-size:20px;
}
</style>
<head>
<title>Login or Signup</title>
<script>
var flag = true;
function authCheckLogin(){//error check for login
//var flag = true;
var textFieldEmail = document.loginForm.emailLogin.value;
var passwordField = document.loginForm.pass.value;
if(textFieldEmail == ""){
document.getElementById("emailTextError").innerHTML = "*Email is required.";
flag = false;
}
else {
	document.getElementById("emailTextError").innerHTML =""; 
}

if(passwordField == ""){
document.getElementById("passwordError").innerHTML = "*Password is required.";
flag = false;
}
else {
	document.getElementById("passwordError").innerHTML = "";
	}
	return flag;
}

function authCheckRegister(){//error check for registration
//var flag = true;
//alert(flag);
var fn = document.registrationForm.firstName.value;
var ln = document.registrationForm.lastName.value;
var un = document.registrationForm.userName.value;
var em = document.registrationForm.emailfield.value;
var ph = document.registrationForm.phone.value;
var np = document.registrationForm.newPassword.value;
var cp = document.registrationForm.cnfirmPassword.value;
var d = document.registrationForm.day.value;
var m = document.registrationForm.month.value;
var y = document.registrationForm.year.value;
var g = document.registrationForm.gender.value

//first name error check
if(fn == ""){                                            
	document.getElementById("FNTextError").innerHTML = "*FirstName Is required.";
	flag = false;
}
else document.getElementById("FNTextError").innerHTML = "";

//last name error check
if(ln == ""){
	document.getElementById("LNTextError").innerHTML = "*LastName Is required.";
	flag = false;
}
else document.getElementById("LNTextError").innerHTML = "";

//username error check
if(un == ""){
	document.getElementById("UNTextError").innerHTML = "*Username field is empty.";
	flag = false;
}
else  document.getElementById("UNTextError").innerHTML = "";

//email error check
if(em == ""){
	document.getElementById("emailTextErrorReg").innerHTML = "*Email field is empty.";
	flag = false;
}
else  {
	document.getElementById("emailTextErrorReg").innerHTML = "";
	if((em.indexOf("@")) == -1 || (em.indexOf(".")) == -1 || em.length<7){
			document.getElementById("emailTextErrorReg").innerHTML = "*Invalid email format.";
			flag = false;
			}
	else document.getElementById("emailTextErrorReg").innerHTML = "";
}
//phone error check
if(ph == ""){
	document.getElementById("phoneTextError").innerHTML = "*Phone number field is empty.";
	flag = false;
}
else { 
	document.getElementById("phoneTextError").innerHTML = "";
	if(isNaN(ph)){//phone number validation
		document.getElementById("phoneTextError").innerHTML = "*Invalid Phone number.";
		flag = false;
	}
	else {
		document.getElementById("phoneTextError").innerHTML = "";
		if(ph.length != 11){//phone number length check
		document.getElementById("phoneTextError").innerHTML = "*Length should be 11.";
		flag = false;
	}
		else document.getElementById("phoneTextError").innerHTML = "";
	}
}
//new password error check
if(np == ""){
	document.getElementById("npassTextError").innerHTML = "*New Password field is empty.";
	flag = false;
}
else{
	 document.getElementById("npassTextError").innerHTML = "";
	 if(np.length<8){//password length checking
	 	document.getElementById("npassTextError").innerHTML = "*Minimum Eight-char needed.";
	 	flag = false;
	 }
	 else document.getElementById("npassTextError").innerHTML = "";
}

//confirmpass error check
if(cp == ""){
	document.getElementById("cnpassTextError").innerHTML = "*Confirm Password field is empty.";
	flag = false;
}
else { 
	document.getElementById("cnpassTextError").innerHTML = "";
	if(cp.length<8){//password length checking
	 	document.getElementById("cnpassTextError").innerHTML = "*Minimum Eight-char needed.";
	 	flag = false;
	 }
	 else {
	 	document.getElementById("cnpassTextError").innerHTML = "";
	if(cp != np){//password matching checks here
		document.getElementById("cnpassTextError").innerHTML = "*Password Mismatched.";
	    flag = false;
	}
	else document.getElementById("cnpassTextError").innerHTML = "";	
	}
}
//DOB error check
if(d == "day" || m == "month" || y == "year"){
	document.getElementById("dobError").innerHTML = "*Select your date of birth.";
	flag = false;
}
else document.getElementById("dobError").innerHTML = "";

//gender error check
if(g == ""){
	document.getElementById("genderError").innerHTML = "*Please select your gender.";
	flag = false;
}
else  document.getElementById("genderError").innerHTML = "";

return flag;
}


function showHint() {
	
	var xmlhttp = new XMLHttpRequest();
	var str = document.registrationForm.userName.value;
	xmlhttp.onreadystatechange = function() {		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	
			m = document.getElementById("UNTextError");
			m.innerHTML=xmlhttp.responseText;
		}
	};
	var url="fetch.php?uname="+str;
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

function compareForMultiple(str,resp){
	for(i = 0;i <resp.length ; i++){
		if(str == resp[i].user_email){
			document.getElementById("emailTextErrorReg").innerHTML = "*Already registered for this email ";
			flag = false;
			break;
		}
		else if(str != resp[i].user_email){
			document.getElementById("emailTextErrorReg").innerHTML = "";
			flag = true;
		}
		
	}
	
}

function showHintEmail() {
	
	var xmlhttp = new XMLHttpRequest();
	var str = document.registrationForm.emailfield.value;
	xmlhttp.onreadystatechange = function() {		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {	
			var m = xmlhttp.responseText;
			var resp=JSON.parse(m);
			//alert(resp[0].email);
			compareForMultiple(str,resp);
		}
	};
	var url="fetchForEmail.php";
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}

</script>
</head>
<body style="background-color:ghostwhite">
<table id="mainTable" style="width:100%">
<tr>
<td style="colspan:2;"><h2 style="color:white;font-size:30px;margin-left: 20px">Chat Me</td>
<td>
<form action="auth.php" method="post" name="loginForm">
<table width="80%" style="padding-left:600px"> 
<tr><td><level style="color:white;font-size:20px;">Email<level></td>
<td><level style="color:white;font-size:20px;">Password<level></td></tr>
<tr>
<td><input type="text" name="emailLogin" style="font-size:15px;" placeholder="Email Address" ></td>
<td><input type="Password" name="pass" style="font-size:15px;" placeholder="Password" ></td>
<td><input type="submit" name="submit" onclick="return authCheckLogin();" value="Login" style="cursor: pointer;background-color: green ;color:white;font-size:15px;"></td>
</tr>
<tr>
<td><span id="emailTextError" style="color: red"></span></td>
<td ><span id="passwordError" style="color: red"></span><br><a style="color:white" href="forgot_password.php">forgotten password?</td>
</tr>
</table>
</form>
</tr>
</table>

<form action="writeData.php" method="post" name="registrationForm">
<h1 style="text-align:center;margin-left: 20em;">Create a new account<h1>
<input style="margin-left: 40em;" id="textfield" size="21" name="firstName" type="text" placeholder="First Name">
<input id="textfield" name="lastName" size="22" type="text" placeholder="Last Name">
<span id="FNTextError" style="color: red;margin-left: 55em;font-size: 15px"></span> <span id="LNTextError" style="color: red;margin-left:10em;font-size: 15px"></span>
<input style="margin-left: 40em;" size="49" id="textfield" name="userName" onkeyup="showHint()" type="text" placeholder="User Name">
<span id="UNTextError" style="color: red;margin-left: 55em;font-size: 15px"></span>
<br>
<input style="margin-left: 40em;" size="49" id="textfield" onkeyup="showHintEmail()" name="emailfield" type="text" placeholder="Email address">
<span id="emailTextErrorReg" style="color: red;margin-left: 55em;font-size: 15px"></span>
<br>
<input style="margin-left: 40em;" size="49" id="textfield" name="phone" type="text" placeholder="Phone number">
<span id="phoneTextError" style="color: red;margin-left: 55em;font-size: 15px"></span>
<br>
<input style="margin-left: 40em;" size="49" id="textfield" name="newPassword" type="password" placeholder="New password">
<span id="npassTextError" style="color: red;margin-left: 55em;font-size: 15px"></span><br>
<input style="margin-left: 40em;" size="49" id="textfield" name="cnfirmPassword" type="password" placeholder="Confirm password">
<span id="cnpassTextError" style="color: red;margin-left: 55em;font-size: 15px"></span><br>
<span style="text-align:center;margin-left: 40em;font-size:20px;">Birthday</span>
<br>
<select name="day" style="margin-left: 42em;font-size:19px">
<option value="day">Day</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>

</select>

<select name="month" style="margin-left:0em;font-size:19px">
<option value="month">Month</option>
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>
<select name="year" style="margin-left: 0em;font-size:19px;">
<option value="year">Year</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
</select>
<span id="dobError" style="color: red;font-size: 15px"></span>
<br>
<span style="text-align:center;margin-left: 40em;font-size:20px;">Country</span>
<br>
<select name="u_country" style="margin-left: 42em;font-size:19px">
							<option disabled>Select your Country</option>
							<option>Bangladesh</option>
							<option>United States of America</option>
							<option>India</option>
							<option>Japan</option>
							<option>UK</option>
							<option>France</option>
							<option>Germany</option>
</select>
<br>
					
<input type="radio" name="gender" value="male" style="margin-left:60em ;"><level style="text-align:center;font-size:20px;">Male</level>
<input type="radio" name="gender" value="female"> <level style="text-align:center;font-size:20px;">Female</level>
<span id="genderError" style="color: red;font-size: 15px"></span>
<br><br>
<input type="submit" name="submit" onclick=" return authCheckRegister();" value="Sign Up" style="background-color:Green;color:white; padding: 10px 20px;text-align: center;margin-left:40em ;font-size:25px;cursor: pointer;">
</form>

</body>
</html>
