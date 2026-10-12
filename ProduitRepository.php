<?php

class ProduitRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function hydrater(array $ligne): Produit
    {
        return new Produit(
            (int) $ligne["id"],
            $ligne["nom"],
            (float) $ligne["prix"],
            (int) $ligne["stock"]
        );
    }

    public function findById(int $id): ?Produit
    {
        $sql = "SELECT id, nom, prix, stock FROM produit WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $id]);

        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ligne === false) {
            return null;
        }

        return $this->hydrater($ligne);
    }

    public function findAll(): array
    {
        $sql = "SELECT id, nom, prix, stock FROM produit";
        $stmt = $this->pdo->query($sql);

        $produits = [];

        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = $this->hydrater($ligne);
        }

        return $produits;
    }
}