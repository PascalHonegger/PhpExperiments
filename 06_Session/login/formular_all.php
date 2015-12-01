<?php 

    // Systemeinstellungen zur Datenbank
        $id = "root"; 
        $pw = ""; 
        $host = "localhost"; 
        $database = "Session";
        $table = "user"; 

    // Einstellungen Ende, Verbindung zur Datenbank aufbauen 

    $conn_id = mysql_connect($host,$id,$pw); 
    mysql_select_db($database,$conn_id); 
?>

<?php
         // Die Variable $fehler ist zu Beginn auf false gesetzt.
         // Falls die Eingabeueberpruefung feststellt, dass das Formular nicht
        // vollstaendig ausgefuellt wurde, wird $fehler auf true gestellt
$fehler = false;
$select = "absender";
         // $meldung ist zu Beginn leer; fall die Mitteilung verschickt wurde oder
         // der Form-Check auf ein Problem gestossen ist, wird der passende 
         // Meldetext in diese Variable gelegt
$meldung = "";
$absender = "";
$vorname = "";
$plz = "";
$ort = "";
$eMail = "";
$geschlecht = "";
$geschenk = "";
$bemerkung = "";
$empfaenger_adressen = array("dominik.waldvogel@bluewin.ch","dom_58@yahoo.de");
$gewaehlte_empfaenger = array();
        //prueft, ob Variable aus submit vorhanden, 
        //wenn nicht (erstes Mal), erstmaliges Aufrufen fuehrt zu Anzeige vom Formular 
        //wenn ja arbeitet er den Block ab                
if(isset($_POST['absender']))
        //prueft, ob Variable aus submit vorhanden, 
        //wenn nicht (erstes Mal), erstmaliges Aufrufen fuehrt zu Anzeige vom Formular 
        //wenn ja arbeitet er den Block ab
{
    include("formtest.php");
    $kunde = $_POST['kunde'];
    $absender = $_POST['absender'];
    $vorname = $_POST['vorname'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $eMail = $_POST['eMail'];
    $geschlecht = $_POST['geschlecht'];
    $geschenk = $_POST['geschenk'];
    $bemerkung = $_POST['bemerkung'];
    if(is_array($_POST['empfaenger'])) $gewaehlte_empfaenger = $_POST['empfaenger'];
                         
      // Eingabe-Check
      // die Eingabedaten werden geprueft => sie duerfen nicht leer sein
     if ($vorname=="" || $absender =="" || $plz =="" || $ort =="" || $eMail =="" || $geschlecht =="" || $geschenk =="-" || count($gewaehlte_empfaenger)==0 || $bemerkung ==""){
        $meldung = "<font color='red'>Bitte alle *-Felder ausf&uuml;llen!</font><br>";
        $fehler = true;
      // falls ein Feld nicht ausgefuellt wurde, wird $fehler auf true
      // gesetzt; in der Variablen $meldung wird der Rueckmeldetext
      // gespeichert
    }
    if($eMail !='' && !teste_email($eMail)){
        $meldung = $meldung."<font color='red'>Bitte E-Mail Adresse &uuml;berpr&uuml;fen!</font><br>";          
        $fehler = true;
    } 
    if($plz !='' && !teste_plz($plz)){
        $meldung = $meldung."<font color='red'>Bitte PLZ &uuml;berpr&uuml;fen!</font><br>";          
        $fehler = true;
    }
            
    // festlegen, in welches Feld der Focus / Select zu setzen ist
    if ($absender==""){
         $select = "absender";
    }
    else if ($vorname==""){
         $select = "vorname";
    }
    else if ($plz=="" || !teste_plz($plz)){
         $select = "plz";
    }
    else if ($ort==""){
         $select = "ort";
    }
    else if ($eMail=="" || !teste_email($eMail)){
         $select = "eMail";
    }
    else if ($bemerkung==""){
         $select = "bemerkung";
    }            
        
    if(!$fehler) {
        $vorname = stripslashes(ereg_replace("\r","",$vorname));
        $absender = stripslashes(ereg_replace("\r","",$absender));
        $plz = stripslashes(ereg_replace("\r","",$plz));
        $ort = stripslashes(ereg_replace("\r","",$ort));
        $eMail = stripslashes(ereg_replace("\r","",$eMail));
        $bemerkung = stripslashes(ereg_replace("\r","",$bemerkung));
               //string ereg_replace ( string Suchmuster, string Ersatz, 
               //string Zeichenkette )
                //Diese Funktion durchsucht Zeichenkette nach �bereinstimmungen 
               //mit Suchmuster und ersetzt dann den �bereinstimmenden Text durch Ersatz. 
                //Gibt einen String ohne evtl. vorhandene "\" (Backslash) zur�ck 
               //(\' wird zu ' usw.). Doppelte R�ckstriche ("\\") werden zu "\" umgesetzt.
             }
        //$empfaenger = "dominik.waldvogel@bluewin.ch";
        $betreff = "Test Formular-Mailer";
        $text = "Kunde: ".$kunde."\nVorname: ".$vorname."\nName: ".$absender."\nPlz: ".$plz."\nOrt: ".$ort."\nE-Mail: ".$eMail."\nGeschlecht: ".$geschlecht."\nGeschenk: ".$geschenk."\nBemerkung: ".$bemerkung;
        $extra = "MIME-Version: 1.0\nContent-Type: text/plain; charset=iso-8859-1\nContent-Transfer-Encoding: quoted-printable\n";
        $extra .= "From:".$eMail."\nX-Mailer:PHP/".phpversion();
        $meldung = "<br><font color='#006600'>Ihre Eingaben wurden erfolgreich an<br><br><b>";

// F�gt einen neuen User in die Datenbank ein  
              mysql_query("insert into $table (vorname,absender) VALUES
            ('$vorname','$absender')"); 

        foreach($gewaehlte_empfaenger as $to){
            @mail($to,$betreff,$text,$extra);
            $meldung .= $to."<br>";
        }
        $meldung .= "</b><br>verschickt. Der neue User wurde erfasst. Danke!</font>";
    }  

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Formular_all</title>
<script language="JavaScript"><!--
    function start(){
          var aktives_Feld = "<?php echo $select; ?>";
        document.forms["Formcheck"][aktives_Feld].select();
    }
// -->
</script>
</head>

<body bgstyle="color:#E7E7E7" link="#006600" vlink="#006600" alink="#00FF00" onload="start()">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="Formcheck">
    
  <table width="300" border="1" align="center" cellpadding="2" cellspacing="1" bgstyle="color:#CCCCCC" borderstyle="color:#999999" bgstyle="color:#FFFFFF">
    <tr bgstyle="color:#FFFFFF"> 
      <td colspan="2"><font style="color:#000000"><b>Formularversand mit PHP</b></font></td>
    </tr>
    <tr bgstyle="color:#FFFFFF"> 
      <td colspan="2"> 
        <?php
         if($fehler || !isset($_POST['absender'])){
         echo $meldung;
         // Beim ersten Aufruf der Seite oder
         // falls der Form-Check ein Problem gefunden hat, 
         // muss das Formular angezeigt werden
        ?>
      </td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php 
       // Nachfolgend werden nicht ausgefuellte Felder mit einem roten
       // Sternchen gekennzeichnet und die schon eingegebenen Werte 
       // wieder in die Felder hinein geschrieben
      if($absender =="" && $fehler){echo "<font color='red'>*Name</font>";}else{echo "<font color='black'>*Name</font>";} ?>
      </td>
      <td bgstyle="color:#999999"> <input type="text" size="30" name="absender" value="<?php echo htmlspecialchars($absender) ?>"> 
        <font style="color:#000000"><b> </b></font> </td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if($vorname =="" && $fehler){echo "<font color='red'>*Vorname</font>";}else{echo "<font color='black'>*Vorname</font>";} ?>
      </td>
      <td bgstyle="color:#999999"> 
        <input type="text" size="30" name="vorname" value="<?php echo htmlspecialchars($vorname) ?>"> 
      </td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if(($plz =="" || ereg("PLZ",$meldung)) && $fehler) {echo "<font color='red'>*PLZ</font>";}else{echo "<font color='black'>*PLZ</font>";} ?>
      </td>
      <td bgstyle="color:#999999"> 
        <input type="text" size="30" name="plz" value="<?php echo htmlspecialchars($plz) ?>"> 
      </td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if($ort =="" && $fehler) {echo "<font color='red'>*Ort</font>";}else{echo "<font color='black'>*Ort</font>";} ?>
      </td>
      <td bgstyle="color:#999999"> 
        <input type="text" size="30" name="ort" value="<?php echo htmlspecialchars($ort) ?>"> 
      </td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if(($eMail =="" || ereg("Mail",$meldung)) && $fehler) {echo "<font color='red'>*E-Mail</font>";}else{echo "<font color='black'>*E-Mail</font>";} ?>
      </td>
      <td bgstyle="color:#999999"> <input type="text" size="30" name="eMail" value="<?php echo htmlspecialchars($eMail) ?>"> 
      </td>
    </tr>
    <tr> 
      <td align="right">Kunde </td>
      <td> <input type="radio" value="JA" name="kunde" checked <?php if( $kunde == "JA")echo " checked"; ?>>
        Ja&nbsp;&nbsp; <input type="radio" value="NEIN" name="kunde" <?php if( $kunde == "NEIN")echo " checked"; ?>>
        Nein</td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if($geschlecht =="" && $fehler) {echo "<font color='red'>*Geschlecht</font>";}else{echo "<font color='black'>*Geschlecht</font>";} ?>
      </td>
      <td><input type="radio" value="F" name="geschlecht" onClick="0"<?php if( $geschlecht == "F")echo " checked"; ?>>
        F&nbsp; &nbsp; <input type="radio" value="M" name="geschlecht" onClick="0"<?php if( $geschlecht == "M")echo " checked"; ?>>
        M</td>
    </tr>
    <tr> 
      <td align="right"> 
        <?php if($geschenk =="-") {echo "<font color='red'>*Geschenk:</font>";}else{echo "<font color='black'>*Geschenk:</font>";} ?>
      </td>
      <td><select name="geschenk" size="1" id="geschenk">
          <option value="-"<?php if($geschenk == "" || $geschenk == "-")echo "selected"; ?>>Bitte 
          w&auml;hlen Sie!</option>
          <option value="Taschenlampe"<?php if($geschenk =="Taschenlampe") echo "selected"; ?>>Taschenlampe</option>
          <option value="Schraubenzieher"<?php if($geschenk =="Schraubenzieher") echo "selected"; ?>>Schraubenzieher</option>
          <option value="Fotorahmen"<?php if($geschenk =="Fotorahmen") echo "selected"; ?>>Fotorahmen</option>
          <option value="Vase"<?php if($geschenk =="Vase") echo "selected"; ?>>Vase</option>
        </select></td>
    </tr>
    <tr> 
      <td align="right" valign="top" nowrap> 
        <?php if($bemerkung =="" && $fehler) {echo "<font color='red'>*Bemerkung:</font>";}else{echo "<font color='black'>*Bemerkung:</font>";} ?>
      </td>
      <td><textarea name="bemerkung" cols="30" rows="5" id="bemerkung"><?php echo $bemerkung ?></textarea></td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <?php if(count($gewaehlte_empfaenger)==0 && $fehler){echo "<font color='red'>*Empf&auml;nger-Mail</font>";}else{echo "<font color='black'>*Empf&auml;nger-Mail</font>";} ?>
        <br> 
        <?php
            foreach($empfaenger_adressen as $mailto){
                echo "<input type=\"checkbox\" name=\"empfaenger[]\" value=\"".$mailto."\" border=\"0\" ";
                if(in_array($mailto,$gewaehlte_empfaenger))echo " checked"; 
                echo ">".$mailto."<br>";
            }
        ?>
      </td>
    </tr>
    <tr align="right"> 
      <td colspan="2"> <input name="reset" type="reset" id="reset" value="Zur&uuml;cksetzen"> 
        <input name="schicken" type="submit" id="schicken" value="Absenden"> </td>
    </tr>
  </table>
</form>
<?php
         }
         else {
             echo $meldung;
             echo "<br><br><br><a href=\"".$_SERVER['PHP_SELF']."\">Zur&uuml;ck zum Mail-Formular</a>";
         }
         ?>
</body>
</html>