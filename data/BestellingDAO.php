<?php
declare(strict_types=1);
require_once('data/autoloader.php');

class BestellingDAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM bestellingen ORDER BY toestand desc, datum_bestelling asc";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $bestelling = new Bestelling((int) $rij['ID'], (int) $rij['klant_ID'], (int) $rij['broodje_ID'], $rij['datum_bestelling'], (string) $rij['toestand']);
            array_push($lijst, $bestelling);
        }
        $dbh = null;

        return $lijst;
    }

    public function addBestelling(Broodje $broodje, User $user)
    {
        $sql = "INSERT INTO bestellingen (klant_ID, broodje_ID, datum_bestelling, toestand) VALUES (:klant_ID, :broodje_ID, :datum_bestelling, :toestand)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klant_ID' => $user->getId(), ':broodje_ID' => $broodje->getId(), ':datum_bestelling' => date('Y-m-d H:i:s'), ':toestand' => "besteld"));
        $dbh = null;
    }

    public function updateBestelling(Bestelling $bestelling)
    {
        $sql = "UPDATE bestellingen SET toestand = :toestand WHERE id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':toestand' => 'afgewerkt', ':id' => $bestelling->getId()));
        $dbh = null;
    }
}