<?php
@session_start();
require_once '../db.php';

$id=0;
if(isset($_GET['id'])) {
  $id=(int)$_GET['id'];
  if($id<=0) {
    header('Location:index.php');
    exit;
  }
}
$produkt=null;
if($id>0) {
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
}

if(!$produkt) {
  //NULL-Objekt Design-Pattern
  $produkt=(object)array(
    'id'=>0,
    'bezeichnung'=>'',
    'beschreibung'=>'',
    'preis'=>''
  );
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Webshop - Produkt bearbeiten</title>
</head>
<body>
<h1>Webshop - Produkt bearbeiten</h1>
<form action="produkt_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <input type="hidden" name="id" value="<?= $produkt->id ?>" />
  <tr>
    <th>Bezeichnung</th>
    <td><input type="text" value="<?= htmlentities($produkt->bezeichnung, ENT_COMPAT) ?>" name="bezeichnung" /></td>
  </tr>
  <tr>
    <th>Beschreibung</th>
    <td><textarea name="beschreibung" style="width:300px;height:200px;"><?= htmlentities($produkt->beschreibung, ENT_COMPAT) ?></textarea></td>
  </tr>
  <tr>
    <th>Preis</th>
    <td><input type="number" name="preis" value="<?= htmlentities($produkt->preis,ENT_COMPAT) ?>" min="0" step="0.01" /></td>
  </tr>
  <tr>
    <th></th>
    <td>
      <input type="submit" value="Speichern" /> 
<?php
if(isset($_SESSION['fehler'])) {
?>
      <div style="color:red;"><?= $_SESSION['fehler'] ?></div>
<?php
    unset($_SESSION['fehler']);
}
?>
    <a href="index.php">Zurück zur Liste</a>
  </td>
  </tr>
</table>
</form>
</body>
</html>