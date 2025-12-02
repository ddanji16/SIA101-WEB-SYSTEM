<?php

// Database connection — keep silent (no output) so header redirects can work
$server = "localhost";
$username = "root";
$password = "";
$db_name = "dbschool";

// enable exceptions for mysqli so failures can be handled instead of printing text
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = mysqli_connect($server, $username, $password, $db_name);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

