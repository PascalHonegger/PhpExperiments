<?php include ("variablen.inc") ?>

<html>
<head>
  <style type="text/css">
    body {background-color: #e7e7e7; font-family : Arial;}
    h1 {font-weight: bold; font-size : 35px;}
    p {font-weight : bold; font-size : 20px;}
    td {font-weight: bold; font-size: 15px; margin: 0px; padding-bottom: 4px;}

  </style>
</head>

<body>
<h1>Welcher Film gef&auml;llt Ihnen am besten?</h1>
<p></p>

<form action="auswertung.php" method="post">
<table>
<?php
  if ($anzahl % 2 == 0) $reihen = $anzahl / 2;
  else $reihen = ($anzahl - 1) / 2;
  $index = 0;
  for ($r = 1; $r <= $reihen; $r++) {
    echo "<tr>";
    for ($s = 0; $s <= 1; $s++) {
      echo "<td><input type=\"radio\" name=\"umfrage\" value=\"$index\"> $werte[$index]</td>";
      $index++;
    }
    echo "</tr>";
  }
  if ($anzahl % 2 == 1) {
    echo "<tr>";
    echo "<td><input type=\"radio\" name=\"umfrage\" value=\"$index\"> $werte[$index]</td>";
    echo "<td></td>";
    echo "</tr>";
  }
?>
</table>
<input type="submit" value="<?= $button_text ?>">
</form>
</body>
</html>
