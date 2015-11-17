<?php

include_once('variablen.inc');

if(!isset($_POST['umfrage']))
{
    throw new RuntimeException('Keine Auswahl getroffen!');
}

$auswahlInt = $_POST['umfrage'];
$auswahlString = $werte[$auswahlInt];

echo 'Ihre Auswahl: '.$auswahlString.'<br>';

$file = fopen($ergebnis, 'r') or die("Datei nicht da!!!");

$fileText = fread($file, filesize($ergebnis));

$fileArray = explode('
', $fileText);

$i = 0;

while($i < sizeof($fileArray))
{
    if($fileArray[$i] == $auswahlString)
    {
        $fileArray[$i + 1]++;
    }

    $sorterFilesArray[$i] = $fileArray[$i];

    $i++;
}

$i = 0;

echo '<table border="1">';

    while($i < sizeof($sorterFilesArray))
    {
        echo '<tr>';
            echo '<td>'.$sorterFilesArray[$i + 1].'</td>';
            echo '<td>'.$sorterFilesArray[$i].'</td>';
        echo '</tr>';
        $i += 2;
    }

echo '</table>';

fclose($file);