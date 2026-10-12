<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

// Test avec un produit existant
$produit = $repository->findById(2);

if ($produit !== null) {
    $produit->afficher();
}

// Test avec un produit qui n'existe pas : rien ne doit s'afficher
$inconnu = $repository->findById(99);

if ($inconnu === null) {
    echo "Aucun produit avec l'id 99.<br>";
}