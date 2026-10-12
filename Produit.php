<?php

class Produit
{
    private ?int $id;
    private string $nom;
    private float $prix;
    private int $stock;

    public function __construct(?int $id, string $nom, float $prix, int $stock)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->stock = $stock;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // Permet d'affecter l'id généré par MySQL après l'insertion
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function afficher(): void
    {
        echo $this->id . " - " . $this->nom . " - "
            . number_format($this->prix, 2, '.', '') . " euros - stock : "
            . $this->stock . "<br>";
    }
}