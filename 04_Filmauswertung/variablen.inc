<?php

// Die Variablen der aktuellen Umfrage
// mit simplem array:
  $werte = array("Original Series", "Next Generation", "Deep Space Nine", "Voyager", "Enterprise", "Animated Adventures" , "dwa", "zzz", "nix so nix", "ich mag keine filme");
  $frage = htmlentities("Welche Star-Trek Serie gefällt Ihnen am besten?");
  $ergebnis = "ergebnis_startrek.txt";
  $button_text = " Daten speichern! ";
  sort($werte);
  $anzahl = count($werte);
  $nz = chr(13).chr(10);

// Falls die Auswertungsdatei nicht exisitiert,
// werden die Zähler mit 0 initialsiert

  if (!file_exists($ergebnis)) {
    $dz = fopen($ergebnis,"w");
    for ($i = 0; $i < $anzahl; $i++) {
      $eintrag = $werte[$i].$nz."0".$nz;
      fwrite($dz,$eintrag);
    }
    fclose($dz);
  }
