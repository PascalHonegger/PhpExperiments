<?php
$meldung = '';
$ok = false;  // wird auf TRUE gesetzt, wenn kein Fehler, s. unten
$max_size = 102400; // in Bytes ($max_size / 1024 ergibt KByte)

// Check: Wurde eine Datei hochgeladen?
if (is_uploaded_file($_FILES['datei']['tmp_name'])) 
{
    // Vorgaben zum Ablageort, zu der Breite und Hoehe des Bildes, 
    // zu den erlaubten Dateitypen und zur Handhabung von Upload-Problemen
    
    $pfad = './bilder/';  // relativer Pfad ../Ordner aufwaerts ./Ordner im gleichen Verzeichnis
  

    $max_bildbreite = 600;
    $max_bildhoehe  = 500;
    $mime_typen     = array(
        'application/x-gzip-compressed'  => '.tar.gz, .tgz',
        'application/x-zip-compressed'   => '.zip',
        'application/x-tar'              => '.tar',
        'text/plain'                     => '.html, .php, .txt, .inc (etc)',
        'image/bmp'                      => '.bmp, .ico',
        'image/gif'                      => '.gif',
        'image/pjpeg'                    => '.jpg, .jpeg',
        'image/jpeg'                     => '.jpg, .jpeg',
        'image/png'                      => '.png',    
        'application/x-shockwave-flash'  => '.swf',
        'application/msword'             => '.doc',
        'application/vnd.ms-excel'       => '.xls',
        'application/octet-stream'       => '.exe , .fla (etc)'
    ); 
    $zugelassene_mimetypen = array('image/gif','image/pjpeg','image/jpeg','image/png');
             
    // Validierung --------------------------------------------------------------------
    
    
        $dateigroesse = $_FILES['datei']['size'];
        $dateityp     = $_FILES['datei']['type'];
        $tmpdateiname = $_FILES['datei']['tmp_name'];
        $dateiname    = $_FILES['datei']['name'];
    

    if ($_FILES['datei']['size']==0) 
    {
       // Fehlermeldung, falls die Datei nichts enthaelt
       $meldung = 'Datei ist leer (max. '.($max_size / 1024).' KByte)';
    }    
    else if ($_FILES['datei']['size'] > $max_size) 
    {
       // Fehler, falls die Dateigroesse die vorgegebene Maximal-Groesse ueberschreitet
       $meldung = 'Datei ist zu gross (max. '.($max_size / 1024).' KByte)';
    }
    else if (!in_array($_FILES['datei']['type'], $zugelassene_mimetypen))
    {
        // Fehler, falls die Datei keinem der vorgegebenen Typen entspricht
        $meldung = 'Falsches Datei-Format. Nur folgende Formate sind erlaubt:\n<ul>';
        
        foreach ($zugelassene_mimetypen as $erlaubter_typ)
        {
            $meldung .= "\n<li>" . $mime_typen[$erlaubter_typ] . ' (' . $erlaubter_typ . ')</li>';
        }
        $meldung .= "\n</ul>";
    }
    else 
    {   // die Datei wird ausgemessen; 
        // Breite und Hoehe kommen in die Variablen $breite und $hoehe
        
        $groesse = GetImageSize($_FILES['datei']['tmp_name']);
        $breite = $groesse[0];
        $hoehe  = $groesse[1];
        
        if ($breite > $max_bildbreite || $hoehe > $max_bildhoehe)
        {
            // Fehler, falls die Datei zu breit oder zu hoch
            $meldung = 'Datei ist zu breit bzw. zu hoch (maximal '.$max_bildbreite.' x '.$max_bildhoehe.' Pixel)';
        }

        if (!in_array($groesse['mime'], $zugelassene_mimetypen))
        {
            // Fehler, falls mit GetImageSize() 
            // ein nicht zugelassenen mime-type gefunden wird,
            // zB wenn 'abc.doc' umbenannt wurde zu 'abc.jpg'
            $meldung = 'Spoofed mime-type - so nicht mein Lieber !';
        }

    }
       

    // Ende des Huerdenlaufs: Die Datei wird vom tmp-Verzeichnis
    // des Web-Servers ins Zielverzeichnis verschoben und benannt (z.B. 'php3E.tmp' zu 'demo.gif').
    // Die Variable $ok wird auf true gesetzt und sorgt so spaeter
    // dafuer, dass das hochgeladene Bild auf der Seite angezeigt wird.
    if ($meldung == '') 
    {
        move_uploaded_file($_FILES['datei']['tmp_name'], $pfad.$_FILES['datei']['name']);
        $meldung = 'Der Bild-Upload hat geklappt.';
        $ok = true;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="imagetoolbar" content="no" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>File-Upload mit PHP</title>
    <style type="text/css"><!--
    .errorJa   { color: red; }
    .errorNein { color: green; }-->
    </style>
</head>

<body>
<?php
if ($meldung != '')
{
    $farbe = ($ok) ? 'errorNein' : 'errorJa';
    
    echo '<p class="'.$farbe.'">'.$meldung.'</p>';
    echo '<p>Hier die Werte der 4 $_FILES[]-Variablen:</p><ul>';

    echo '<li>Name der Datei auf dem User-PC: <b>'.$_FILES['datei']['name'].'</b> <br />= $_FILES[\'datei\'][\'name\']</li>';
    echo '<li>Datei-Typ: <b>'.$_FILES['datei']['type'].'</b> <br />$_FILES[\'datei\'][\'type\']</li>';
    echo '<li>Tempor&auml;rer Name auf dem Server: <b>'.$_FILES['datei']['tmp_name'].'</b> <br />= $_FILES[\'datei\'][\'tmp_name\']</li>';
    echo '<li>Datei-Gr&ouml;sse: <b>'.$_FILES['datei']['size'].'</b> <br />= $_FILES[\'datei\'][\'size\']</li></ul>';
    
    echo "\n<pre>";
    print_r($_FILES);
    echo "</pre>\n\n";

    if (isset($groesse))
    {
        echo '...und die Werte des Array $groesse (GetImageSize):';
        echo "\n<pre>";
        print_r($groesse);
        echo "</pre>\n\n";
    }
}

if ($ok)
{
    echo '<p><img src="'.$pfad.$_FILES['datei']['name'].'" '.$groesse[3].' alt="" border="0" /></p>';
}
?>
     
    <p><b>Bild-Datei auf den Server hochladen:</b></p>
    <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>" />
        <input type="file"   name="datei" /> &nbsp; 
        <input type="submit" name="verschicken" value="Bild auf den Server laden" />
    </form>
</body>
</html>