<?php
/**
 * Created by Pascal
 * Date: 01.12.2015
 */

// Systemeinstellungen Artikel
$id = "root";
$pw = "";
$host = "localhost";
$database = "artikel";
// Einstellungen Ende

session_start();

// Validierung Anmeldung

$angemeldet = isset($_SESSION['angemeldet']) ? $_SESSION['angemeldet'] : false;

if(!$angemeldet)
{
    header("Location: index.php");
    die("Diese Datei sollte tot sein!");
}

// Validierung erfolgreich

$connection = mysqli_connect ($host, $id, $pw, $database);

$action = isset($_GET['action']) ? $_GET['action'] : "Keine Aktion";

$nr = isset($_GET['nr']) ? $_GET['nr'] : null;

$artnr = isset($_GET['artnr']) ? $_GET['artnr'] : null;

$titel = isset($_GET['titel']) ? $_GET['titel'] : null;

$preis = isset($_GET['preis']) ? $_GET['preis'] : null;

$inhalt = isset($_GET['inhalt']) ? $_GET['inhalt'] : null;

$meldung = "Keine Meldung";

$PHP_SELF = $_SERVER["PHP_SELF"];

// Löscht einen Artikel aus der Datenbank
if ($action == "loeschen") {
mysqli_query ($connection, "delete from artikel1 where nr = '$nr'");
$meldung = "Der Artikel wurde gelöscht.";

// Aktualisiert einen Datensatz
} elseif($action == "save") {


mysqli_query($connection, "update artikel1 set artnr = $artnr, titel = '$titel', preis = '$preis', inhalt =
'$inhalt' where nr = '$nr'");
$meldung = "Der Artikel wurde upgedated.";

// Fügt einen neuen Artikel hinzu
} elseif ($action == "neu") {
mysqli_query ($connection, "insert into artikel1 (titel, artnr, preis, inhalt) VALUES
('$titel', '$artnr', '$preis', '$inhalt')");
$meldung = "Der Artikel wurde hinzugefügt.";

// Selektiert den ausgewählten Artikel zu Updaten
} elseif ($action == "update") {
$result = mysqli_query($connection, "select * from artikel1 where nr =  '$nr'");
$resultArray = $result->fetch_assoc();
$titel = $resultArray['titel'];
$artnr = $resultArray['artnr'];
$preis = $resultArray['preis'];
$inhalt = $resultArray['inhalt'];
?>

<table>
    <form action=<?php echo $PHP_SELF; ?> method=get>
    <input type=hidden name=action value="save">
    <input type=hidden name=nr VALUE="<?php echo $nr ?>">
    <tr>
        <td><label for="artnr">Art.-Nr.</label></td>
        <td><input id="artnr" type=text name="artnr" value="<?php echo $artnr ?>"></td>
    </tr>
    <tr>
        <td><label for="titel">Titel</label></td>
        <td><input id="titel" type=text name="titel" value="<?php echo $titel ?>"></td>
    </tr>
    <tr>
        <td><label for="preis">Preis</label></td>
        <td><input id="preis" type=text name="preis" value="<?php echo $preis ?>"></td>
    </tr>
    <tr>
        <td><label for="inhalt">Text</label></td>
        <td><textarea id="inhalt" name="inhalt"><?php echo $inhalt ?></textarea>
    </tr>
    <tr>
        <td><input type=submit value="Artikel Updaten"></form></td>
    </tr>
</table><p>

<?php

// Formular für ein neues Produkt
} elseif($action == "formneu" ) {

?>
<table>
    <form action=<?php echo $PHP_SELF; ?> method=get>
    <input type=hidden name=action value="neu">
    <tr>
        <td><label for="artnr">Art.-Nr.</label></td>
        <td><input id="artnr" type=text name="artnr"></td>
    </tr>
    <tr>
        <td><label for="titel">Titel</label></td>
        <td><input id="titel" type=text name="titel"></td>
    </tr>
    <tr>
        <td><label for="preis">Preis</label></td>
        <td><input id="preis" type=text name="preis"></td>
    </tr>
    <tr>
        <td><label for="inhalt">Text</label></td>
        <td><textarea id="inhalt" name="inhalt"></textarea></td>
    </tr>
    <tr>
        <td> </td>
        <td><input type=submit value="Neuen Artikel hinzufügen"></form></td>
    </tr>
</table><p>

<?php
// Gibt alle Datensätze aus der Datenbank aus.
} else {

echo "<ol><b>Alle Artikel in der Übersicht:</b>";
echo "<br>";
echo "<table border= 'l' width='700'>";
echo "<tr bgcolor='#00cc00'><td width='100'><b>Art.-Nr.<b></td>
<td width='100'><b>Artikel</b></td>
<td width='100'><b>Preis</b></td>
<td width='300'><b>inhalt</b></td>
<td width='50' ><b>Update</b></td>
<td width='50'><b>Löschen</b></td></tr>";

$result = mysqli_query($connection, "select * from artikel1");
if ($num = mysqli_num_rows($result)) {
// Ausgabe der Datensätze, wenn vorhanden
for ($i=0;$i < $num; $i++) {

if(isset($bgColor))
{
    $bgColor = $bgColor=="#ffffff" ?  "#888888" : "#ffffff";
}
else
{
    $bgColor = "#888888";
}

$resultArray = $result->fetch_assoc();
$titel = $resultArray['titel'];
$artnr = $resultArray['artnr'];
$preis = $resultArray['preis'];
$inhalt = $resultArray['inhalt'];
$nr = $resultArray['nr'];

echo "<tr bgColor = \"$bgColor\">";
echo "<td>$artnr</td>";
echo "<td>$titel</td>";
echo "<td>$preis Fr. -</td>";
echo "<td>$inhalt</td>";
echo "<td><a href=\"$PHP_SELF?nr=$nr&action=update\">Update</a></td>";
echo "<td><a href=\"$PHP_SELF?nr=$nr&action=loeschen\">Löschen</a></td>"; }
echo "</tr>";

} else echo "<tr><td colspan='6' width='100%'>kein Artikel vorhanden!</td></tr>";
echo "</table>";
echo "</ol>";
}
echo "<ol>";
if (!$meldung) $meldung = "Optionen<P>";
echo "$meldung";

echo "<p><a href=$PHP_SELF>Zur Startseite</a>";
echo " - <a href=$PHP_SELF?action=formneu>Neuen Artikel einfügen</a>";
echo "</ol>";
?>