<?php
/**
 * Created by PhpStorm.
 * User: Pascal
 * Date: 10.11.2015
 * Time: 14:26
 */

session_start();

echo $_SESSION["user"].'<Br>';

echo '<a href="logout.php" >log-out</a>';