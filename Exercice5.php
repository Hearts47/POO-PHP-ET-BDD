<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

$produits = $repository->findAll();

foreach ($produits as $produit) {
    $produit->afficher();
}

$produit = $repository->findById(3);

if ($produit !== null) {
    $produit->afficher();
}
