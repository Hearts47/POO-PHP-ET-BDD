<?php
require_once "ConnexionPDO.php";


$stmt = $pdo->query("select id, nom, prix, stock from produit where id = 1");

$ligne = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($ligne);


echo "Produit : " . $ligne["nom"] . "<br>";
echo "Prix : " . $ligne["prix"] . "<br>";
echo "Stock : " . $ligne["stock"] . "<br>";

// le type de la variable retournée par fetch() est un tableau associatif (array) contenant les colonnes de la table produit

?>