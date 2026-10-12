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

    public function findByNom(string $recherche): array
    {
        $sql = "SELECT id, nom, prix, stock FROM produit WHERE nom LIKE :recherche";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["recherche" => "%" . $recherche . "%"]);

        $produits = [];

        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = $this->hydrater($ligne);
        }

        return $produits;
    }

    public function insert(Produit $produit): void
    {
        $sql = "INSERT INTO produit(nom, prix, stock)
                VALUES (:nom, :prix, :stock)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "nom" => $produit->getNom(),
            "prix" => $produit->getPrix(),
            "stock" => $produit->getStock()
        ]);

        $produit->setId((int) $this->pdo->lastInsertId());
    }

    public function update(Produit $produit): void
    {
        $sql = "UPDATE produit
                SET nom = :nom,
                    prix = :prix,
                    stock = :stock
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "nom" => $produit->getNom(),
            "prix" => $produit->getPrix(),
            "stock" => $produit->getStock(),
            "id" => $produit->getId()
        ]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM produit WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $id]);
    }
}