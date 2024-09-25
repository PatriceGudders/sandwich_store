<?php

declare(strict_types=1);
require_once('data/autoloader.php');
session_start();

//Als er geen cookie is, redirect naar de login pagina
if (!isset($_COOKIE['user'])) {
    header('Location: home.php');
    exit(0);
}

$bestelSvc = new BestellingService();
$broodjeSvc = new BroodjeService();
$userSvc = new UserService();

$lijst_bestellingen = $bestelSvc->getBestellingen();
$lijst_users = $userSvc->getUsers();

//Check welke actie er uitgevoerd moet worden, voer de actie uit, en redirect naar een 'frisse' pagina
if (isset($_GET['afwerk_id']) && $_GET['afwerk_id'] != "") {
    //Update bestelling hier
    $bestelling = $bestelSvc->getBestellingById((int) $_GET['afwerk_id']);
    $bestelSvc->updateBestelling($bestelling);
    $_SESSION['feedback'] = 'Broodje afgewerkt!';
    $_SESSION['feedback_color'] = 'green';
    header("Location: overzicht.php");
    exit(0);
} elseif (isset($_GET['blokkeer_id']) && $_GET['blokkeer_id'] != "") {
    $user = $userSvc->getUserById((int) $_GET['blokkeer_id']);
    $userSvc->blockUser($user);
    $_SESSION['feedback'] = 'Gebruiker geblokkeerd!';
    $_SESSION['feedback_color'] = 'green';
    header("Location: overzicht.php");
    exit(0);
} elseif (isset($_GET['activeer_id']) && $_GET['activeer_id'] != "") {
    $user = $userSvc->getUserById((int) $_GET['activeer_id']);
    $userSvc->unblockUser($user);
    $_SESSION['feedback'] = 'Gebruiker gedeblokkeerd!';
    $_SESSION['feedback_color'] = 'green';
    header("Location: overzicht.php");
    exit(0);
}

include('presentation/Overzichtformulier.php');

if (isset($_SESSION['feedback'])) {
    $feedback = new Feedback($_SESSION['feedback'], $_SESSION['feedback_color']);
    echo $feedback->getFeedback();
    unset($_SESSION['feedback']);
    unset($_SESSION['feedback_color']);
}
