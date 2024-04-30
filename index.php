<?php
@session_start();
require_once 'db.php';

$suche='';
if(isset($_POST['suche'])) {
  $suche=$_POST['suche'];
  $_SESSION['suche']=$suche;
} else if(isset($_SESSION['suche'])) {
  $suche=$_SESSION['suche'];
}

$produkte=[];
if(!empty($suche)) {
  $suchkriterium='%'.$suche.'%';
  $stmt=$db->prepare("SELECT id,bezeichnung,preis FROM `produkt` WHERE bezeichnung LIKE ? OR beschreibung LIKE ?");
  $stmt->bind_param('ss', $suchkriterium, $suchkriterium);
  $stmt->execute();
  $result=$stmt->get_result();
  while($produkt=$result->fetch_object()) {
    $produkte[]=$produkt;
  }
  $result->free();
}

$seitentitel='Webshop - Produktsuche';
require_once 'seitenanfang.php';
?>
<form action="index.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
Produktsuche: <input type="text" name="suche" value="<?= htmlentities($suche, ENT_COMPAT) ?>"/><input type="submit" value="🔍"/>
</form>
<br />
<?php
if(empty($produkte)) {
  if(empty($suche)) {
    echo 'Tolle produkte im Angebot! Benutzen Sie die Suchfunktion!';
  } else {
    echo 'Keine Produkte gefunden :-(';
  }
}  else {
?>
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>
    <th class="knopf">Produkt-ID</th>
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
    <td><?php printf("%0.2f", $produkt->preis) ?> €</td>
    <td>
      <a href="produkt_anzeigen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Anzeigen</a>
      <a class="knopf klein" href="produkt_kaufen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">In den Warenkorb</a>
    </td>
  </tr>
<?php
}
?>
</table>
<?php
}
require_once 'seitenende.php';
// Funktioniert ohne und/oder falsches ende == require_once 'seitenanfang.php';
?>