<?php
$user = "root";
$password = "";
$DBName = "TestDB";
$server = "127.0.0.1";
$serverName = "localhost";

$mysqli = mysqli_connect($server, $user, $password);

if($mysqli->connect_errno)
{
    echo "Errööör";
    exit("Server is broken :(");
}
else
{
    echo "Connection established!";
}

$GLOBALS['DBConnection'] = $mysqli;