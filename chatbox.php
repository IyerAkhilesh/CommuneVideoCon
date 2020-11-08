<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat App</title>
    <script defer src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script defer src="script.js"></script>
    <style>
      body {
          padding: 0;
          margin: 0;
          display: flex;
          justify-content: center;
      }

      #message-container {
        width: 80%;
        max-width: 1200px;
      }

      #message-container div {
        background-color: #CCC;
        padding: 5px;
      }

      #message-container div:nth-child(2n) {
        background-color: #FFF;
      }

      #send-container {
        position: fixed;
        padding-bottom: 30px;
        bottom: 0;
        background-color: white;
        max-width: 1200px;
        width: 80%;
        display: flex;
      }

      #message-input {
        flex-grow: 1;
      }
    </style>
  </head>
  
  <body>
    <div id="message-container"></div>
    <form id="send-container">
      <input type="text" id="message-input">
      <button type="submit" id="send-button">Send</button>
    </form>
  </body>
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

  $sql = "YOUR_QUERY";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
  ?>
</html>