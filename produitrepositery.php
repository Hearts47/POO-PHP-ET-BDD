<?php

class ProduitRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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

        return new Produit(
            (int) $ligne["id"],
            $ligne["nom"],
            (float) $ligne["prix"],
            (int) $ligne["stock"]
        );
    }
}