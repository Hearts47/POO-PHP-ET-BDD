<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);

$produit = $repository->findById(1);

echo "<h3>Avant modification</h3>";
$produit->afficher();

$produit->setPrix(74.90);
$produit->setStock(20);

echo "<h3>Après setPrix/setStock, avant update() (relu depuis la base)</h3>";
$repository->findById(1)->afficher();

// 4. On enregistre la modification
$repository->update($produit);

echo "<h3>Après update() (relu depuis la base)</h3>";
$repository->findById(1)->afficher();

echo "<h3>Test des validations</h3>";

try {
    $produit->setPrix(-5);
} catch (InvalidArgumentException $e) {
    echo "Erreur attendue : " . $e->getMessage() . "<br>";
}

try {
    $produit->setStock(-1);
} catch (InvalidArgumentException $e) {
    echo "Erreur attendue : " . $e->getMessage() . "<br>";
}

try {
    $produit->setNom("");
} catch (InvalidArgumentException $e) {
    echo "Erreur attendue : " . $e->getMessage() . "<br>";
}