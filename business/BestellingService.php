<?php

declare(strict_types=1);
require_once('data/autoloader.php');
class BestellingService
{
    public function getBestellingen(): array
    {
        $bestellingDAO = new BestellingDAO();
        $lijst_bestellingen = $bestellingDAO->getAll();
        return $lijst_bestellingen;
    }

    public function addBestelling(Broodje $broodje, User $user)
    {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->addBestelling($broodje, $user);
    }

    public function updateBestelling(Bestelling $bestelling)
    {
        $bestellingDAO = new BestellingDAO();
        $bestellingDAO->updateBestelling($bestelling);
    }

    public function getBestellingById($id)
    {
        $lijst_bestellingen = $this->getBestellingen();
        foreach ($lijst_bestellingen as $bestelling) {
            if ($bestelling->getId() == $id) {
                return $bestelling;
            }
        }
    }

    public function getBestellingToestandAction(Bestelling $bestelling)
    {
        $string_toestand = 'Afgewerkt';

        if ($bestelling->getToestand() === 'besteld') {
            $string_toestand = 'Besteld <a href="overzicht.php?afwerk_id=' . $bestelling->getId() . '">(Afwerken)</a>';
        }

        return $string_toestand;
    }
}
