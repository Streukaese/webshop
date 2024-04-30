<?php
@session_start();
//require_once 'db.php';

$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id>0) {
    if(!isset($_SESSION['warenkorb'])) {
        // wenn es noch gar keinen Warenkorb gibt.
        // ihn erstellen mit der Produkt-ID als Key und Anzahl == 1 als Value
        // und in die Session merken
        $_SESSION['warenkorb']=array($id => 1);
    } else if(!isset($_SESSION['warenkorb'][$id])){
        // wenn es den Warenkornb gibt, aber er noch die gegebene ProduktID enthält.
        // dann diese ProduktID als Key hinzufügen, mit Anzahl==1
        $_SESSION['warenkorb'][$id] = 1;   // [$id] == array($id);
    } else {
        // Wenn es diese ProduktID im Warenkorb schon gitb, dann die entsprechende Anzahl erhöhen
        $_SESSION['warenkorb'][$id]++;
    }
}
header('Location:warenkorb.php');
exit;
?>