<?php
/**
 * Created by Pascal
 * Date: 01.12.2015
 */

session_start();

// Bereits angemeldet
$angemeldet = isset($_SESSION['angemeldet']) ? $_SESSION['angemeldet'] : false;

if($angemeldet == true)
{
    header("Location: artikel.php");
    die("Bereits angemeldet!");
}

echo "<html><head>
        <title>Pascals Testformular</title>
    </head>
    <body>
        <form action=\"login.php\" method=\"post\">
            <label for=\"username\">Benutzername</label><input id=\"username\" name=\"username\" type=\"text\" required=\"required\"/>
            <label for=\"password\">Passwort</label><input id=\"password\" name=\"password\" type=\"password\" required=\"required\"/>
            <input type=\"submit\" value=\"Absenden\" />
        </form>
    </body>
</html>";