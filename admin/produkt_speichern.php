<?php
@session_start();
require_once '../db.php';

$id=isset($_POST['id']) ? (int)$_POST['id'] : 0;
// id == 0 -> ok => bedeutet "produkt hinzufügen"

$bezeichnung=isset($_POST['bezeichnung']) ? $_POST['bezeichnung'] : false;
if(empty($bezeichnung)) {
  $_SESSION['fehler']='Bitte eine Bezeichnung eingeben';
  header('Location:produkt_bearbeiten.php?id='.$id);
  exit;
}
$beschreibung=isset($_POST['beschreibung']) ? $_POST['beschreibung'] : false;
if(empty($beschreibung)) {
  $_SESSION['fehler']='Bitte eine Beschreibung eingeben';
  header('Location:produkt_bearbeiten.php?id='.$id);
  exit;
}
$beschreibung=str_replace("\r", "\n", str_replace("\r\n", "\n", $beschreibung));
if(!isset($_POST['preis'])) {
  $_SESSION['fehler']='Bitte einen Preis eingeben';
  header('Location:produkt_bearbeiten.php?id='.$id);
  exit;
}
$preis=(float) $_POST['preis'];
if($preis<=0.0) {
  $_SESSION['fehler']='Bitte einen positiven Preis eingeben';
  header('Location:produkt_bearbeiten.php?id='.$id);
  exit;
}

if($id>0) {
  $stmt=$db->prepare("UPDATE `produkt` SET `bezeichnung` = ?, `beschreibung` = ?, `preis` = ? WHERE `produkt`.`id` = ?");
  $stmt->bind_param('ssdi', $bezeichnung, $beschreibung, $preis, $id);
  $stmt->execute();
  $_SESSION['erfolg']='Produkt geändert!';
} else {
  $stmt=$db->prepare("INSERT INTO `produkt` (`id`, `bezeichnung`, `beschreibung`, `preis`) VALUES (NULL, ?, ?, ?)");
  $stmt->bind_param('ssd', $bezeichnung, $beschreibung, $preis);
  $stmt->execute();
  //$stmt->insert_id
  //$id=$db->insert_id;
  $_SESSION['erfolg']='Produkt hinzugefügt!';
}
header('Location:index.php');
exit;
?>