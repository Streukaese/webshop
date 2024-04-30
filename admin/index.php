<?php
@session_start();
require_once '../db.php';
$produkte=array();
$result=$db->query("SELECT id,bezeichnung,preis from produkt ORDER by beschreibung");
while($produkt=$result->fetch_object()){
  $produkte[]=$produkt;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Adminbereich</title>
</head>
<body>
<h1>Webshop - Adminbereich</h1>
<a href="produkt_bearbeiten.php">Neues Produkt</a>
<?php
if(isset($_SESSION['erfolg'])) {
?>
  <div style="color:green;"><?= $_SESSION['erfolg'] ?></div>
<?php
  unset($_SESSION['erfolg']);
}
?>
<table border="1" style="border-collapse:collapse;">
  <tr>
    <th>Produkt-ID</th>
    <th>Bezeichnung</th>
    <th>Preis</th>
    <th></th>

  </tr>
<?php
foreach($produkte as $produkt) {
?>
<tr>
  <td><?= htmlentities($produkt->id, ENT_COMPAT) ?></td>
  <td><?= htmlentities($produkt->bezeichnung, ENT_COMPAT) ?></td>
  <td><?php printf("%0.2f",$produkt->preis) ?> €</td>
  <td>
    <a href="produkt_anzeigen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Anzeigen</a>
    <a href="produkt_bearbeiten.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Bearbeiten</a>
    <a href="produkt_loeschen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Löschen</a>
  </td>
</tr>
<?php
}
?>
</table>
</body>
</html>