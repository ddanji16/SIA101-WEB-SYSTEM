<?php




$server = "localhost";
$username = "root";
$password = "";
$db_name = "dbschool";
$con = "";


$con = mysqli_connect($server, $username, $password, $db_name);


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully to the database!";
}

?>

