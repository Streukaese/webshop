<?php
@session_start();
require_once 'db.php';

$produkte=[];
$result=$db->query("SELECT id, bezeichnung, preis FROM `produkt` WHERE id IN(".implode(',',array_keys($_SESSION['warenkorb'])).")");
// if(isset($_SESSION['warenkorb']) && !empty($_SESSION['warenkorb'])) {
    //wenn es einen Warenkorb gibt und er nicht leer ist,
    //dann enthält er die bestellten ProduktIDs als Keys und die jeweilige Anzahl als Values
    //wir holen aus der DB die Produkte, deren ID in den Keys des Warenkorbs sind
while($produkt=$result->fetch_object()) {
  $produkte[]=$produkt;
}
$result->free();
// }

$seitentitel='Webshop - Warenkorb';
require_once 'seitenanfang.php';
?>
<?php
// if(empty($produkte)) {
    // echo 'Ihr Warenkorb ist leer.';
// } else {
?>
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th>Produkt-ID</th>
    <th>Bezeichnung</th>
    <th>Einzelpreis</th>
    <th>Anzahl</th>
    <th>Preis</th>
    <th></th>
  </tr>
<?php
$gesamtpreis=0.0;
foreach($produkte as $produkt) {
    $anzahl=$_SESSION['warenkorb'][$produkt->id];
    $gesamtpreis += $produkt->preis * $anzahl;
?>
<tr>
  <td><?= htmlentities($produkt->id, ENT_COMPAT) ?></td>
  <td><?= htmlentities($produkt->bezeichnung, ENT_COMPAT) ?></td>
  <td align="right"><?php printf("%0.2f",$produkt->preis) ?> €</td>
  <td align="right"><?= $anzahl ?></td>
  <td align="right"><?php printf("%0.2f",$produkt->preis*$anzahl) ?> €</td>
  <td>
    <a class="knopf gross" href="produkt_anzeigen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Anzeigen</a>
    
    <a href="produkt_loeschen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Löschen</a>
  </td>
</tr>
<a href="index.php">Zurück zur Produktsuche</a>
<?php
}
?>
    <tr>
        <th align="right" colspan="4">Gesamt:</th>
        <th align="right"><?php printf("%0.2f", $gesamtpreis) ?> €</th>
        <th></th>
    </tr>
</table>
<?php
// }
?>
<br />
<br />
<!-- Inhalt der Session: <?php var_dump($_SESSION) ?> -->
<?php
require_once 'seitenende.php';
?>