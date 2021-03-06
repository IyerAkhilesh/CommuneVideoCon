<!DOCTYPE html>
<html>
	<head>
		<title>Commune Video Conference</title>
		
		<style type="text/css">
			.tab {
				overflow: hidden;
  				border: 1px solid #ccc;
				background-color: #f1f1f1;
			}

			.tab button {
				background-color: #e6e6e6;
				float: left;
				border: none;
				outline: none;
				cursor: pointer;
				padding: 14px 16px;
				transition: 0.3s;
				font-size: 17px;
			}

			.tab button:hover {
				background-color: #cdcdcd;
			}

			.tab button.active {
				background-color: #bcbcbc;
			}

			/* width */
			::-webkit-scrollbar {
			  width: 0.5em;
			  height: 3em;
			  border-radius: 3px 3px 3px 3px;
			}

			/* Track */
			::-webkit-scrollbar-track {
			  background: #00000000; 
			}
			 
			/* Handle */
			::-webkit-scrollbar-thumb {
			  background: #eeee00; 
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
			  background: #999900; 
			}

			div.scrollmenu {
			  background-color: #151515;
			  overflow: auto;
			  white-space: nowrap;
			}

			div.scrollmenu a {
			  display: inline-block;
			  color: white;
			  text-align: center;
			  padding: 14px;
			  text-decoration: none;
			}

			div.scrollmenu a:hover {
			  background-color: #353535;
			}
		</style>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/theme/base16-dark.css">

		<script src= "https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.js"></script>
		<script src= "https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/mode/javascript/javascript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	</head>

	<body style="background: black">

		<div style="position: fixed; left: 1%; top: 1%; width:63%; height: 63%; background: #151515; text-align: center; font-weight: bolder">
			<video autoplay="true" id="videoElement" style="width: 100%; height: 100%">
				
			</video>
		</div>
		
		<div class="tab" style="position: absolute;left:65%; top:1%; width: auto; height: auto">
			<button class="tablinks" id="notes_button">Notes</button>
			<button class="tablinks" id="code_button">Code</button>
			<!-- <button class="tablinks" id="quiz" onclick="clickHandle(event, 'Quiz')">Quiz</button> -->
		</div>

		<div id="notesDiv" style="position: absolute; left:65%; top:10%; width: 35.5em; height: 24.5em; background: white; padding: 0.25em 0.25em">
			<textarea id="NotesArea" class="tabcontent" style="width: 89.5%; height: 68%;  background: #151515; border: none; padding: 2em 1em 1em 3em; color: white;">
			</textarea>
			<button id="notes_download" style="position: absolute; left:75%; top:87%; height: 2.5em; width: 6em; background: radial-gradient(#efefeff1, #84b295f1, #11944ff1); font-family: sans-serif; font-weight: bold; font-size: 1em">Save</button>
		</div>
		
		<div id="codeDiv" style="position: absolute; left:65%; top:10%; width: 35.5em; height: 24.5em; display: none;  background: white; padding: 0.25em 0.25em">
			<textarea id="CodeArea" class="tabcontent" style="width: 100%; height: 80%; background: white">
			</textarea>
			<button id="code_download" style="position: absolute; left:75%; top:87%; height: 2.5em; width: 6em; background: radial-gradient(#efefeff1, #84b295f1, #11944ff1); font-family: sans-serif; font-weight: bold; font-size: 1em">Save</button>
		</div>
		
		<!-- <div style="position: absolute; left:65%; top:10%; width: 32em; height: 25em">
			<textarea id="Quiz" class="tabcontent" style="width: 100%; height: 100%; background: white">
			</textarea>
			<button style="position: absolute; left:10%; top:85%; height: 2.5em; width: 6em; background: radial-gradient(#efefeff1, #84b295f1, #11944ff1); font-family: sans-serif; font-weight: bold; font-size: 1em">Save</button>
		</div> -->
		


		<div id="chatbox" style="position: fixed; left: 65%; top: 59%; width:36em; height: 20.75em; background: white; text-align: center; font-weight: bolder"> 
			<div id="person_a" style="position: absolute;left:0.25em;top:0.25em; width:98%; height: 97%;background: #151515">
				<textarea id="person_a_text" style="position: absolute;left: 0em;top: 0.05em; width: 89%; height: 1.5em; background: #f3f3f305; color:white; font-size: 1.5em;">
				</textarea>
				<button name="chatsend" id="chatsend" style="position: absolute;left: 90%;top: 0em; width: 10%; height: 2.8em; background: #f3f3f322; color:white; font-weight: bold" >SEND</button>
				<div id="chat_display" style="position: absolute;left: 0em;top: 3em; width: 100%; height: 17em; background: #f3f3f305; color:white; font-weight: bold"></div>
			</div>
		</div>
		
		<div style="position: fixed; left: 1%; top: 65%; width:63%; height: 33%; background: #BBBBBB; text-align: center; font-weight: bolder">
			<iframe src="../ppt/Sample.pdf" style="width:100%; height:100%" frameborder="0"></iframe>
		</div>
	</body>

	<script type="text/javascript">
		var video = document.querySelector("#videoElement");

		if (navigator.mediaDevices.getUserMedia) {
			navigator.mediaDevices.getUserMedia({ video: true })
			.then(function (stream) {
				video.srcObject = stream;
			})
			.catch(function (err0r) {
				console.log("Something went wrong!");
			});
		}
		
		var codemirrorEditor;
		var code_text="";
		// When the Notes tab is selected, the display for the Code tab is turned off
		document.querySelector("#notes_button").addEventListener("click", function(){
			document.querySelector("#codeDiv").style.display = "none";
			document.querySelector("#code_button").className = document.querySelector("#code_button").className.replace(" active", "");

			// Destroy the CodeMirror instance so that it doesn't overlap with the Notes Textare
			codemirrorEditor.setOption("mode", "text/x-csrc");
			codemirrorEditor.getWrapperElement().parentNode.removeChild(codemirrorEditor.getWrapperElement());
			// Getting the latest value in the code tab so that the next time the tab is selected, it can be put back into the codemirror
			code_text = codemirrorEditor.getValue();
			codemirrorEditor=null;

			document.querySelector("#notesDiv").style.display = "block";
			document.querySelector("#notes_button").className += " active";			
		});

		function getToday(){
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();
			return mm + '/' + dd + '/' + yyyy;
		}

		// When the Code tab is selected, the display for the Notes tab is turned off
		document.querySelector("#code_button").addEventListener("click", function(){
			document.querySelector("#notesDiv").style.display = "none";
			document.querySelector("#notes_button").className = document.querySelector("#code_button").className.replace(" active", "");
			
			document.querySelector("#codeDiv").style.display = "block";
			document.querySelector("#code_button").className += " active";
			// Creating a code mirror in place of the text area of the code tab
			codemirrorEditor = CodeMirror.fromTextArea(document.querySelector("#CodeArea"), {
	  			lineNumbers: true,
	  			mode: "javascript",
	  			theme: "base16-dark"
			});
			
			// Setting the last value of the codetab back into it. Will be an empty string if no code is writ
			codemirrorEditor.setValue(code_text);
		});

		
	
		document.querySelector("#notes_download").addEventListener("click", function(){

			// sendToDatabase("/notes/NewNotes"+getToday()+".txt");

			var ul = document.querySelector("#notesDiv");
			day = getToday();
		    ul.innerHTML += `
		    	<form method="post" id="uselessform" style='display=none;' action="">
					<input type="text" name='padname' value="NotesForLecOn_`+day+`.txt" style='display:none;'>
				</form>
		    `;
		    document.querySelector("#uselessform").submit();

		// This code block is for downloading and saving the file to the local device for now. Will be migrated on to AWS FSx later 
		   	var textFileAsBlob = new Blob([document.querySelector("#NotesArea").value], {type:'text/plain'}); 
	    	var downloadLink = document.createElement("a");
	    	downloadLink.download = "NotesOfLecOn_"+getToday();
	    	downloadLink.innerHTML = "Download File";
	    	if (window.webkitURL != null)
	    	{
	    		// Chrome allows the link to be clicked
	    		// without actually adding it to the DOM.
	    		downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
	    	}
	    	else
	    	{

	    		// Firefox requires the link to be added to the DOM
	    		// before it can be clicked.
	    		downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
	    		downloadLink.onclick = destroyClickedElement;
	    		downloadLink.style.display = "none";
	    		document.body.appendChild(downloadLink);
	    	}
	    
	    	downloadLink.click();
	    });

	    document.querySelector("#code_download").addEventListener("click", function(){

			var ul = document.querySelector("#codeDiv");
		    var day = getToday();
		    ul.innerHTML += `
		    	<form method="post" id="uselesform" style='display=none;' action="">
					<input type="text" name='padname' value="CodeForLecOn_`+day+`.txt" style='display:none;'>
				</form>
		    `;
		    document.querySelector("#uselesform").submit();
	    	
	    	console.log(code_text);
		   	var textFileAsBlob = new Blob([codemirrorEditor.getValue()], {type:'text/python'}); 
	    	var downloadLink = document.createElement("a");
	    	downloadLink.download = "CodeForLecOn_"+getToday();
	    	downloadLink.innerHTML = "Download File";
	    	if (window.webkitURL != null)
	    	{
	    		// Chrome allows the link to be clicked
	    		// without actually adding it to the DOM.
	    		downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
	    	}
	    	else
	    	{

	    		// Firefox requires the link to be added to the DOM
	    		// before it can be clicked.
	    		downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
	    		downloadLink.onclick = destroyClickedElement;
	    		downloadLink.style.display = "none";
	    		document.body.appendChild(downloadLink);
	    	}
	    
	    	downloadLink.click();
	    });


	    // Send the message to the chatbox
	    document.querySelector("#chatsend").addEventListener("click", function(){
	    	appendMessage(document.querySelector("#person_a_text").value);
	    });
	</script>
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
		// $padname = "CodeForLec001_11/08/2020";
		echo strpos($padname, "Code")  !== false;
		// if(isset($_REQUEST['#notes_download']) or isset($_REQUEST['#code_download']))
		$padname = $_POST['padname'];

		$check = mysqli_query($conn, "select count(1) from personal_data_lecture where `lecture_name` = 'programming0001_001' ");
		if (strpos($padname, "Notes") !== false){
			// printf($check);
			echo $check[0];
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

		mysqli_query($conn, $sql);
		?>
</html>
<!-- 
	// function sendToDatabase(snd_value){
		// 	// If we want to get a folder as a module, we need to provide the path to its index.js file. This is because the
		// 	// variable can only consist of a JS file		
			
			
		// 	// request = $.ajax({
		//  //        url: "./conn_db.php",
		//  //        type: "post",
		//  //        data: snd_value
		//  //    });

		//     var ul = document.querySelector("#notesDiv");
		//     ul.innerHTML += `
		//     	<form method="post" onload="this.submit()" style='display=none;' action="<?php echo $_SERVER['PHP_SELF'];?>">
		// 			<input type="text" id='test' value="`+snd_value+`" style='display:none;'>
		// 		</form>
		//     `;
		//     var values= document.querySelector("#test").value;
		//     $.ajax({
		// 	    url: "./db_connect.py",
		// 	    type: "post",
		// 	    datatype: "data",
		// 	    data: {padname: values},
		// 	    success: function(response){
		// 	        console.log(response.message);
		// 	    }
		// 	});
		//     alert();
		// }

 -->
