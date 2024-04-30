<?php
session_start(); // Session starten

// Überprüfen, ob die Produkt-ID übergeben wurde
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Überprüfen, ob das Produkt im Warenkorb existiert
    if(isset($_SESSION['warenkorb'][$id])) {
        // Produkt aus dem Warenkorb entfernen
        unset($_SESSION['warenkorb'][$id]);
    }
}

// Weiterleitung zurückschicken
header("Location: warenkorb.php");
exit;
?>


<!-- <?php
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id<=0) {
    header("Location:index.php");
    exit;
}

require_once 'db.php';
$stmt=$db->prepare("");
$stmt->bind_param('i', $id);
$stmt->execute();
header("Location:index.php");
exit;
?> -->