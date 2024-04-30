<?php
require_once '../db.php';

if(!isset($_GET['id'])) {
  header('Location:index.php');
  exit;
}
$id=(int)$_GET['id'];
if($id<=0) {
  header('Location:index.php');
  exit;
}

$stmt=$db->prepare("SELECT * FROM `produkt` WHERE id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
$result=$stmt->get_result();
$produkt=$result->fetch_object();
$result->free();
if(!$produkt) {
  //nicht gefunden
  header('Location:index.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Produkt Vorschau</title>
</head>
<body>
<h1>Webshop - Produkt Vorschau</h1>
<h2><?= htmlentities($produkt->bezeichnung, ENT_COMPAT) ?></h2>
<div class="preis"><?php printf("%0.2f", $produkt->preis) ?> €</div>
<div class="beschreibung"><?= nl2br($produkt->beschreibung, ENT_COMPAT) ?></div>
<a href="index.php">Zurück zur Liste</a> <a href="produkt_bearbeiten.php?id=<?= htmlentities($produkt->id,ENT_COMPAT) ?>">Produkt Bearbeiten</a>

</body>
</html>