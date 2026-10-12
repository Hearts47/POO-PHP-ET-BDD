<?php
require_once "ConnexionPDO.php";
require_once "Produit.php";
require_once "ProduitRepository.php";

$repository = new ProduitRepository($pdo);
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $produit = new Produit(
            null,
            trim($_POST["nom"] ?? ""),
            (float) ($_POST["prix"] ?? 0),
            (int) ($_POST["stock"] ?? 0)
        );

        $repository->insert($produit);

        header("Location: Exercice10.php?ajout=ok");
        exit;
    } catch (InvalidArgumentException $e) {
        $erreur = $e->getMessage();
    }
}

$recherche = trim($_GET["recherche"] ?? "");

if ($recherche !== "") {
    $produits = $repository->findByNom($recherche);
} else {
    $produits = $repository->findAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue de produits</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 2rem auto; }
        table { border-collapse: collapse; width: 100%; margin: 1rem 0; }
        th, td { border: 1px solid #999; padding: 6px 10px; text-align: left; }
        th { background: #eee; }
        .erreur { color: #b00020; }
        .succes { color: #2e7d32; }
        form { margin: 1rem 0; }
    </style>
</head>
<body>
    <h1>Catalogue de produits</h1>

    <?php if (($_GET["ajout"] ?? "") === "ok"): ?>
        <p class="succes">Produit ajouté.</p>
    <?php endif; ?>

    <form method="get" action="Exercice10.php">
        <label>Nom du produit :
            <input type="text" name="recherche"
                   value="<?= htmlspecialchars($recherche, ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <button type="submit">Rechercher</button>
        <a href="Exercice10.php">Tout afficher</a>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
        </tr>
        <?php foreach ($produits as $produit): ?>
            <tr>
                <td><?= $produit->getId() ?></td>
                <td><?= htmlspecialchars($produit->getNom(), ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= number_format($produit->getPrix(), 2, '.', '') ?> €</td>
                <td><?= $produit->getStock() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (count($produits) === 0): ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>

    <h2>Ajouter un produit</h2>

    <?php if ($erreur !== ""): ?>
        <p class="erreur"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post" action="Exercice10.php">
        <p><label>Nom : <input type="text" name="nom" required></label></p>
        <p><label>Prix : <input type="number" name="prix" step="0.01" min="0" required></label></p>
        <p><label>Stock : <input type="number" name="stock" min="0" required></label></p>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
<?php