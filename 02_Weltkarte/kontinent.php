<?php

$kontinent = $_GET["kontinent"];

$url= 'images/'.$kontinent.'.gif';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $kontinent ?></title>
</head>
<body>
    <h1><?php echo $kontinent ?></h1>
    <img src="<?php echo $url ?>"/>
    <a href="index.html">Back</a>
</body>
</html>