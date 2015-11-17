<?php

require_once('connection.php');

$query = 'SELECT * FROM createdbyide';

$db = $GLOBALS['DBConnection'];

$result = $db->query($query) or die(mysqli_error($db));

while($row = mysqli_fetch_assoc($result))
{
    echo $row['Username'].'<br>';
}