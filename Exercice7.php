<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

$produit = new Produit(
    null,
    "Disque SSD 1 To",
    89.90,
    7
);

echo "Id avant insertion : ";
var_dump($produit->getId());   
echo "<br>";

$repository->insert($produit);

echo "Id après insertion : ";
var_dump($produit->getId());
echo "<br>";

$relu = $repository->findById($produit->getId());

if ($relu !== null) {
    $relu->afficher();
}