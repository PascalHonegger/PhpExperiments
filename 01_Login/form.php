<?php
/**
 * Created by Pascal Honegger
 */

session_start();

if(isset($_POST["favColorInput"]))
{
    $_SESSION["color"] = $_POST['favColorInput'];
}

if(isset($_POST["favAnimalInput"]))
{
    $_SESSION["animal"] = $_POST['favAnimalInput'];
}

if(isset($_POST["user"]))
{
    $_SESSION["user"] = $_POST['user'];
}

$color = $_SESSION["color"];
$animal = $_SESSION["animal"];

echo 'Du bist ein '.$color.' '.$animal;

echo '<a href="newForm.php" >LINK</a>';