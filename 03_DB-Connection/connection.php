<?php
$user = "root";
$password = "";
$DBName = "TestDB";
$server = "127.0.0.1";
$serverName = "localhost";

$mysqli = mysqli_connect($server, $user, $password, $DBName);

if($mysqli->connect_errno)
{
    echo "Errööör";
    exit("Server is broken :(");
}

$GLOBALS['DBConnection'] = $mysqli;

$db->close();