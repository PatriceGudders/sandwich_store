<?php

declare(strict_types=1);

class Broodje
{
    private $id;
    private $naam;
    private $omschrijving;
    private $prijs;


    public function __construct(int $id, string $naam, string $omschrijving, float $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNaam()
    {
        return $this->naam;
    }

    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    public function getPrijs()
    {
        return $this->prijs;
    }
}
