<?php
/**
 * Created by Pascal
 * Date: 01.12.2015
 */


if(isset($_POST['username']) && isset($_POST['password']))
{
    // Systemeinstellungen Anmeldung
    $userArtikel = "root";
    $pwArtikel = "";
    $hostArtikel = "localhost";
    $databaseArtikel = "artikel";
    // Einstellungen Ende

    $connection = mysqli_connect($hostArtikel, $userArtikel, $pwArtikel, $databaseArtikel);

    $username = $_POST['username'];

    $password = $_POST['password'];

    $validUser = false;

    $validUser = $connection->query("select id from login where 'username' = '$username' and 'password' = '$password'");

    var_dump($validUser);

    if (is_bool($validUser)) {
        $_SESSION['angemeldet'] = false;
    } else {
        $resutls = $validUser->fetch_assoc();
        if ($resutls['id'] != null) {
            $_SESSION['angemeldet'] = true;
        }
    }

    header("Location: artikel.php");
    die("Anmelden erfolgreich");
}