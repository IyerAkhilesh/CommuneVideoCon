<?php
	$servername = "127.0.0.1:3306";
	$username = "akhilesh";
	$password = "akhilesh";
	$dbname = "commune";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);


	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}


	$sql = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		if(isset($_POST["signupbtn"])){
			$stud_id = $_POST['studid'];
			$passwrd = $_POST['passwrd'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$dob = $_POST['dob'];

			$sql = "insert into student_info values('$stud_id', '$passwrd', '$name', '$email', '$phone', '$dob')";
			$result = mysqli_query($conn, $sql);
		}

		elseif(isset($_POST["loginbtn"])) {
			$studentid = $_POST['studentid'];
			$password = $_POST['password'];

			$sql = "select count(1) from student_info where `student_id`='$studentid' and `password`='$password' ";
			$temp = mysqli_query($conn, $sql);
			$result = mysqli_fetch_array($temp);
			print_r($result[0]);

			if ($result[0] == 1){
				header("Location:main.html");
				exit();
			}
		}
	}
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login and Signup</title>
	</head>
	<body>
		<img src="../res/WallpaperOne.jpg" style="width:100%; height: 100%; position:fixed; left: 0%; top:0%; z-index: -1">		
			<!-- TITLE DIVISION -->
		<div style="position: fixed; left: 15%; top: 0%; width:70%; height: 12.5%; background: #f3f3f3; text-align: center; font-weight: bolder; box-shadow: 0em 0em 0.5em 0.2em #000000; z-index: 1" onclick="location.href='video_call.html'">
			<img src="../res/Logo.png" style="position: absolute; top:5%; left: 40%; filter: saturate(300%) contrast(2.0)"/>
		</div>

		<form id="login" method="post" action="" style="position: absolute; left: 27.5em; top: 17.5em; width: 20em; height: 15em; background: radial-gradient(#efefeff1, #84b295f1, #11944ff1); box-shadow: 0em 0em 0.5em 0.2em #000000;">

				<input type="text" name="studentid" id="studentid" style="position: absolute; left: 2.5em; top:2.5em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value=" Student ID" onfocus="this.value = '' " />

				<input type="password" name="password" id="password" value=" Password" style="position: absolute; left: 2.5em; top:6em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em"onfocus="this.value = '' "/>

				<button type="submit" name="loginbtn" value="Login" style="position: absolute; left: 5em; top:10em; width:5em; height:2em; background: #002200; font-size: 1em; font-family: sans-serif; color:white; box-shadow: 0em 0em 0.2em 0.1em #000000;">Login</button> 
		</form>


		<div id="div_line" style="position: absolute; left: 48.5em; top: 12.5em; height: 25em; width: 0.48em; background: #550000"></div>


		<form id="signup" method="post" action="" style="position: absolute; left: 50em; top: 15em; width: 20em; height: 25em; background: radial-gradient(#efefeff1, #84b295f1, #11944ff1); box-shadow: 0em 0em 0.3em 0.1em #000000;">

			<input type="text" name="studid" id="studid" style="position: absolute; left: 2.5em; top:2em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value=" Student ID" onfocus="this.value = '' " />

			<input type="password" name="passwrd" id="passwrd" value=" Password" style="position: absolute; left: 2.5em; top:5em; width:12.5em; height:2em; background: #ffffff00;  
			border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em"onfocus="this.value = '' "/>

			<input type="text" name="name" id="name" style="position: absolute; left: 2.5em; top:8em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value=" Name" onfocus="this.value = '' " />

			<input type="email" name="email" id="emailid" style="position: absolute; left: 2.5em; top:11em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value=" Email" onfocus="this.value = '' " />

			<input type="tel" name="phone" id="phone" style="position: absolute; left: 2.5em; top:14em; width:12.5em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value=" Phone Number" onfocus="this.value = '' "/>

			<input type="date" name="dob" id="dob" style="position: absolute; left: 3.25em; top:21.5em; width:16em; height:2em; background: #ffffff00;  
				border-bottom: 0.15em solid black; border-left: none; border-right: none; border-top: none; font-size: 1em" value="Date of Birth" onfocus="this.value = '' " placeholder="yyyy/MM/dd" />	<label style="position: relative; left: 10em; top:19.5em; font-weight: bold">Date of birth</label>						

			<button type="submit" name="signupbtn"  id="signup_submit" value="Signup" style="position: absolute; left: 6em; top:22em; width:5em; height:2em; background: #002200; font-size: 1em; font-family: sans-serif; color:white; box-shadow: 0em 0em 0.2em 0.1em #000000;">Signup</button> <!-- onclick="signupCall(document.querySelector('#studentid').value, document.querySelector('#password').value), document.querySelector('#name').value, document.querySelector('#email').value, document.querySelector('#phone').value, document.querySelector('#dob').value" --> 
		</form>
	</body>
</html>
