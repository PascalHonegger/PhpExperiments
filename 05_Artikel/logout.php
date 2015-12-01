<?php
/**
 * Created by Pascal
 * Date: 01.12.2015
 */

session_start();

session_destroy();

header("Location: index.php");
die("Diese Seite ist nun nutzlos!");