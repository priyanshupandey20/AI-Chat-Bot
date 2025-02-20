<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>AI Chat Bot</title>
    <link rel="icon" type="image/x-icon" href="ai.png">
    <meta property="og:title" content="AI Chat Bot">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://webpublic.in/AI%20Chat-Bot/ai.png">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1282">
    <meta property="og:url" content="https://webpublic.in/AI%20Chat-Bot/index.php">


<script>
  (function() {
    var before = new Date().getTime();
    debugger; // Pauses script execution if dev tools are open
    var after = new Date().getTime();

    // Check if there's a significant delay due to dev tools
    if (after - before > 100) {
      window.location.href = "about:blank"; // Redirect if developer tools are open
    }
  })();
</script>

<script>
  // Disable right-click context menu
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });

  // Disable F12 (Inspect Element), Ctrl+Shift+I (Dev Tools), and Ctrl+U (View Source)
  document.addEventListener('keydown', function(e) {
    // Disable F12 key
    if (e.keyCode === 123) {
      e.preventDefault();
      return false;
    }

    // Disable Ctrl+Shift+I and Ctrl+U
    if ((e.ctrlKey && e.shiftKey && e.keyCode === 73) || (e.ctrlKey && e.keyCode === 85)) {
      e.preventDefault();
      return false;
    }
  });
</script>



</head>




<style>


*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

body
{
width: 100%;
height: 100vh;
}

.chat-container
{
width: 100%;
height: 80%;
background-color: rgb(45, 52, 59);
display: flex;
flex-direction: column;
gap: 20px;
overflow: auto;
}

.user-chat-box
{
width: 60%;
position: relative;
left: 40%;
padding: 20px;
}

.ai-chat-box
{
width: 60%;
position: relative;
padding: 20px;
}

.user-chat-area
{
width: 93%;
padding: 20px;
background-color: black;
color: rgba(255, 255, 255, 0.639);
border-radius: 40px 0px 40px 40px;
box-shadow: 2px 2px 10px black;
display: flex;
flex-direction: column;
gap: 10px;
}

.ai-chat-area
{
width: 90%;
padding: 20px;
background-color: rgba(0, 0, 0, 0.361);
position: relative;
left: 10%;
color: rgba(255, 255, 255, 0.639);
border-radius: 0px 40px 40px 40px;
box-shadow: 2px 2px 10px black;
}

#userImage
{
position: absolute;
right: 0;
filter: drop-shadow(2px 2px 10px black);
}

#aiImage
{
position: absolute;
left: 0;
filter: drop-shadow(2px 2px 10px black);
}

.prompt-area
{
width: 100%;
height: 20%;
background-color:rgb(45, 52, 59);
display: flex;
align-items: center;
justify-content: center;
gap: 10px;
}

.prompt-area input
{
width: 50%;
height: 60px;
background-color: black;
border: none;
outline: none;
border-radius: 50px;
padding: 20px;
color: white;
font-size: 20px;
box-shadow: 2px 2px 10px black;
}

.prompt-area button
{
width: 50px;
height: 50px;
border-radius: 50%;
background-color: black;
border: none;
box-shadow: 2px 2px 10px black;
cursor: pointer;
transition: all 0.5s;
}
.prompt-area button:hover
{
background-color: rgba(0, 0, 0, 0.338);
}

.load
{
filter: drop-shadow(2px 2px 10px black);
}

.chooseimg
{
width: 30%;
border-radius: 1rem;
}

.choose
{
width: 40px;
height: 40px;
border-radius: 50%;
}
#image
{
display: flex;
align-items: center;
justify-content: center;
}

@media (max-width:600px) {
 
.user-chat-box
{
width: 80%;
left: 20%;
padding: 0;
padding-right: 13px;
}

.ai-chat-box
{
width: 80%;
padding: 0;
padding-left: 10px;
}

.chat-container
{
padding-top: 20px;
}

.prompt-area input
{
width: 60%;
}

.chooseimg
{
width: 50%;
border-radius: 1rem;
}


</style>

<body>

    <div class="chat-container">

        <div class="ai-chat-box">
            <img src="ai.png" alt="" id="aiImage" width="11%">
            <div class="ai-chat-area">
                Hello ! How Can I Help you Today?
            </div>
            
        </div>
    </div>


    <div class="prompt-area">
        <input type="text" id="prompt" placeholder="Message..." required>
        <button id="image"><img src="img.svg" alt="">
        <input type="file" accept="image/*" hidden></button>
        <button id="submit"><img src="submit.svg" alt=""></button>
    </div> 




<script src="script.js"></script>   
</body>
</html>


<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the time zone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

// #################################################
// FIND THE CLIENT IP ADDRESS
// #################################################

// Using PHP 7+ syntax for retrieving IP address
$clientIP = $_SERVER['HTTP_CLIENT_IP'] 
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] // when behind Cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
    ?? $_SERVER['HTTP_X_FORWARDED'] 
    ?? $_SERVER['HTTP_FORWARDED_FOR'] 
    ?? $_SERVER['HTTP_FORWARDED'] 
    ?? $_SERVER['REMOTE_ADDR'] 
    ?? '0.0.0.0';

// #################################################
// GET LATITUDE, LONGITUDE, AND CITY USING IP
// #################################################

// Fetch geolocation data using ip-api service
$apiURL = "http://ip-api.com/json/{$clientIP}";
$response = file_get_contents($apiURL);
$data = json_decode($response, true);

// Check if the API returned success
if ($data && $data['status'] === 'success') {
    $latitude = $data['lat'] ?? null;
    $longitude = $data['lon'] ?? null;
    $city = $data['city'] ?? null;
} else {
    // If the API fails, default to null for location data
    $latitude = $longitude = $city = null;
}

// #################################################
// FETCH CURRENT DATE AND TIME
// #################################################

// Fetch current date and time in the 'Y-m-d H:i:s' format
$deta = date('Y-m-d H:i:s');

// #################################################
// DATABASE CONNECTION SETUP
// #################################################

$servername = "";
$username = "";
$password = "";
$dbname = ""; 

// Establish connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// #################################################
// INSERT LOCATION DATA INTO DATABASE
// #################################################

// Prepare the SQL query to insert date, IP, latitude, longitude, and city
$sql = "INSERT INTO location_data (deta, ip, latitude, longitude, city) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters (date, IP, latitude, longitude, city) and execute the prepared statement
    $stmt->bind_param("sssss", $deta, $clientIP, $latitude, $longitude, $city);
    if ($stmt->execute()) {
        // Optional success message
        // echo "New record created successfully<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>"; // Debugging: Error message for insertion
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error . "<br>"; // Debugging: Error preparing statement
}

// Close the database connection
$conn->close();

?>
