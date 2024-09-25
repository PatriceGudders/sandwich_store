<?php
declare(strict_types=1);
require_once('data/autoloader.php');

class BroodjeDAO
{
    public function getAll() : array
    {
        $sql = "SELECT * FROM broodjes";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new Broodje((int) $rij['ID'], (string) $rij['Naam'], (string) $rij['Omschrijving'], (float) $rij['Prijs']);
            array_push($lijst, $broodje);
        }
        $dbh = null;

        return $lijst;
    }
}