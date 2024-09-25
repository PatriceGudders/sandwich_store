<?php

declare(strict_types=1);
require_once('data/autoloader.php');
class BroodjeService
{
    public function getBroodjes(): array
    {
        $broodjeDAO = new BroodjeDAO();
        $lijst_broodjes = $broodjeDAO->getAll();
        return $lijst_broodjes;
    }

    public function getBroodjeById(int $broodje_id): ?Broodje
    {
        $lijst_broodjes = $this->getBroodjes();
        foreach ($lijst_broodjes as $broodje) {
            if ($broodje->getId() === $broodje_id) {
                return $broodje;
            }
        }
    }
}
