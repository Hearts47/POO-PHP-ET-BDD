<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

echo "<h3>Recherche : clavier</h3>";
$produits = $repository->findByNom("clavier");

foreach ($produits as $produit) {
    $produit->afficher();
}

echo "<h3>Recherche : e</h3>";
foreach ($repository->findByNom("e") as $produit) {
    $produit->afficher();
}

echo "<h3>Recherche : zzz</h3>";
$produits = $repository->findByNom("zzz");

if (count($produits) === 0) {
    echo "Aucun produit trouvé.<br>";
}