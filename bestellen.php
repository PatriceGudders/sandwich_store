<?php
declare(strict_types=1);
require_once('data/autoloader.php');
session_start();

//Als de cookie met de username al geset is, redirect naar het overzicht
if (!isset($_COOKIE['user'])) {
    header('Location: home.php');
    exit(0);
}

$bestelSvc = new BestellingService();
$broodjeSvc = new BroodjeService();
$userSvc = new UserService();


$lijst_broodjes = $broodjeSvc->getBroodjes();

if ((isset($_GET['action']) && $_GET['action'] == 'bestel') && (isset($_GET['id_broodje']) && $_GET['id_broodje'] !== '')) {
    //add bestelling hier
    $bestelSvc->addBestelling($broodjeSvc->getBroodjeById((int) $_GET['id_broodje']), $userSvc->getUserById((int) unserialize($_COOKIE['user'], ['User'])->getId()));

    $_SESSION['feedback'] = 'Broodje besteld!';
    $_SESSION['feedback_color'] = 'green';
    header('Location: bestellen.php');
    exit(0);
}

include('presentation/Bestelformulier.php');

if (isset($_SESSION['feedback'])) {   
    $feedback = new Feedback($_SESSION['feedback'], $_SESSION['feedback_color']);
    echo $feedback->getFeedback();
    unset($_SESSION['feedback']);
    unset($_SESSION['feedback_color']);
}