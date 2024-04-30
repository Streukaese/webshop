<?php
require_once 'db.php';

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

$seitentitel='Webshop -'.$produkt->bezeichnung;
require_once 'seitenanfang.php'
?>
<h2><?= htmlentities($produkt->bezeichnung, ENT_COMPAT) ?></h2>
<div class="preis"><?php printf("%0.2f", $produkt->preis) ?> €</div>
<div class="beschreibung"><?= nl2br($produkt->beschreibung, ENT_COMPAT) ?></div>
<br />
<h2>
  <a class="knopf gross" href="produkt_kaufen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">In den Warenkorb</a>
<form action="warenkorb.php" method="post" enctype="multipart/from-data" accept-charset="UTF-8">
  <a class="knopf klein" href="warenkorb.php" value="🔍">Zum Warenkorb</a>
  <input class="knopf klein" type="submit" value="🛒">
</h2>
</form>
<?php
require_once 'seitenende.php';
?>