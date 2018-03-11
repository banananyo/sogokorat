<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sogokorat";

// $servername = "localhost";
// $username = "dkhousec";
// $password = "fh5Ye3QcvRq";
// $dbname = "dkhousec_sogo";

$mysqli = new mysqli($servername, $username, $password, $dbname);



      // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("SET NAMES 'utf8'");
      // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>