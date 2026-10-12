<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";

$stmt = $pdo->query("SELECT id, nom, prix, stock FROM produit WHERE id = 1");
$ligne = $stmt->fetch(PDO::FETCH_ASSOC);

$produit = new Produit(
    (int) $ligne["id"],
    $ligne["nom"],
    (float) $ligne["prix"],
    (int) $ligne["stock"]
);


$produit->afficher();

