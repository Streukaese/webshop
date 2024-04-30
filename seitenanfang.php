<?php
// erwartet globale variable: $seitentitel
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?= htmlentities($seitentitel,ENT_COMPAT) ?></title>
    <style>
    @media screen and (min-width:800px) {
        #menue {
            border:1px dashed black;
            padding-top:1vh;
            padding-bottom:1vh;
            padding-left:1vw;
            padding-right:1vw;
        }
        #menue a {
            display:inline-block;
        }
        #menue .trenner {
            display:inline-block;
            padding-left:15px;
            padding-right:15px;
        }
        #menue #oeffner {
            display:none;
        }
    }
    @media screen and (max-width:800px) {
        #menue #oeffner {
            display:block;
        }
        #menue a {
            display:none;
        }
        #menue .trenner {
            display:none;
        }
        #menue:hover {
            display:inline-block;
            border:1px solid black;
            padding:5px;
            margin-right:1em;
            margin-bottom:1em;
        }
        #menue:hover #oeffner {
            display:none;
        }
        #menue:hover a {
            display:block;
        }
    }
        a {
            color:black;
            text-decoration:none;
        }
        a:hover {
            background-color:rgb(200,200,200);
        }
        a.knopf {
            display:inline-block;
            border:1px:solid black;
            background-color:crimson !important; /* rgb(200,200,200) || indianred */
            color:white;
            padding:2px;
            border-radius:5px;
            cursor: pointer;
        }
        .klein {
            font-size:12px;
        }
        .gross {
            font-size:16px;
            font-weight:bold;
        }
    </style>
</head>
<body>
<h1><?= htmlentities($seitentitel,ENT_COMPAT) ?></h1>
<div id="menue">
    <div id="oeffner">☰</div>
    <a href="index.php">Produktsuche</a><br />
    <div class="trenner"></div>
    <a href="warenkorb.php">Warenkorb</a><br />
</div>
<br />