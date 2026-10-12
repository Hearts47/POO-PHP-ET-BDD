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

        $this->setNom($nom);
        $this->setPrix($prix);
        $this->setStock($stock);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        if (trim($nom) === "") {
            throw new InvalidArgumentException("Le nom ne doit pas etre vide.");
        }

        $this->nom = $nom;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): void
    {
        if ($prix < 0) {
            throw new InvalidArgumentException("Le prix ne peut pas etre negatif.");
        }

        $this->prix = $prix;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        if ($stock < 0) {
            throw new InvalidArgumentException("Le stock ne peut pas etre negatif.");
        }

        $this->stock = $stock;
    }

    public function afficher(): void
    {
        echo $this->id . " - " . $this->nom . " - "
            . number_format($this->prix, 2, '.', '') . " euros - stock : "
            . $this->stock . "<br>";
    }
}