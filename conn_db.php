<?php
		echo "PHP welcomes you";
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
		echo "Connected successfully";

		$sql = "";
		$padname = "CodeForLec001_11/08/2020";
		echo strpos($padname, "Code")  !== false;
		// if(isset($_REQUEST['#notes_download']) or isset($_REQUEST['#code_download']))
		// 	$padname = $_POST['padname'];

		$check = mysqli_query($conn, "select count(1) from personal_data_lecture where `lecture_name` = 'programming0001_001' ");
		if (strpos($padname, "Notes") !== false){
			// printf($check);
			if (mysqli_query($conn, "select count(1) from personal_data_lecture where `lecture_name` = 'programming0001_001 ") == 0)
				$sql = "insert into personal_data_lecture values (5, 'programming', 'raj', 'ScreenshotsForLec001', '$padname', 'StatusTrailsForLec001.txt', 'AssignmentsForLec001.txt', '')";
			else
				$sql = "update personal_data_lecture values set `notes` = '$padname' where `lecture_name` = = 'programming0001_001' ";
		}

		if (strpos($padname, "Code") !== false){
			// printf($check);
			if (mysqli_query($conn, "select count(1) from personal_data_lecture where `lecture_name` = 'programming0001_001 ") == 0)
				$sql = "insert into personal_data_lecture values (5, 'programming', 'raj', 'ScreenshotsForLec001', '', 'StatusTrailsForLec001.txt', 'AssignmentsForLec001.txt', '$padname')";
			else
				$sql = "update personal_data_lecture values set `code` = '$padname' where `lecture_name` = = 'programming0001_001' ";
		}
		// $sql = "insert into personal_data_lecture values (2, 'programming', 'raj', 'none', '"+$_POST['name']+"', '', '', '')";

		if (mysqli_query($conn, $sql)) {
		  echo "Record updated successfully";
		} else {
		  echo "Error updating record: " . mysqli_error($conn);
		}	
	?>