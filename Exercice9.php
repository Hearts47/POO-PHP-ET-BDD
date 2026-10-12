<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

echo "<h3>Avant delete(5)</h3>";
$produit = $repository->findById(5);

if ($produit !== null) {
    $produit->afficher();
} else {
    echo "Le produit 5 n'existe pas (déjà supprimé ?).<br>";
}

$repository->delete(5);

echo "<h3>Après delete(5)</h3>";
$produit = $repository->findById(5);

if ($produit === null) {
    echo "Le produit 5 n'existe plus : suppression réussie.<br>";
}