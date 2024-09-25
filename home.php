<?php

declare(strict_types=1);
require_once('data/autoloader.php');
session_start();

$userSVC = new UserService();

//Als action loguit is
if (isset($_GET["action"]) && $_GET["action"] === "loguit") {
    //zet de cookie naar een tijd in het verleden om deze te verwijderen 
    setcookie('user', '', time() - 3600);
    header('Location: home.php');
    exit(0); //stopt de rest van het script
}

//Redirect naar de juiste pagina als user al ingelogd is
if (isset($_COOKIE['user'])) {
    if (unserialize($_COOKIE['user'], ['User'])->getSoort() == 'medewerker') {
        header('Location: overzicht.php');
    } else {
        header('Location: bestellen.php');
    }
}

//Als action login is
if (isset($_GET["action"]) && $_GET["action"] === "login") {

    $toegelaten = $userSVC->validateUser((string)strtolower($_POST['log_email']), (string)$_POST["log_password"]);

    if ($toegelaten) {
        //works: echo $_POST['log_email'];
        $user = $userSVC->getUserByEmail($_POST['log_email']);

        setcookie('user', serialize($user));

        if ($user->getSoort() == 'medewerker') {
            header('Location: overzicht.php');
            exit(0);
        } else {
            header('Location: bestellen.php');
            exit(0);
        }
    } else {
        $_SESSION['feedback'] = 'We kunnen je niet inloggen met deze gegevens. Controleer de gegevens of neem contact op met administratie.';
        $_SESSION['feedback_color'] = 'red';
        header('Location: home.php');
        exit(0);
    }
}

//Als action register is
if (isset($_GET["action"]) && $_GET["action"] === "register") {
    $username = $_POST['reg_username'];
    $email = strtolower($_POST['reg_email']);
    $password = $_POST['reg_password'];
    $password2 = $_POST['reg_password2'];

    if ($userSVC->validatePasswordRepetition($password, $password2)) {
        if ($userSVC->validateEmail($email)) {
            $userSVC->addUser($username, $email, password_hash($password, PASSWORD_DEFAULT));
            $_SESSION['feedback'] = 'Account aangemaakt! U kan nu inloggen.';
            $_SESSION['feedback_color'] = 'green';
        } else {
            $_SESSION['feedback'] = 'Dit account bestaat al.';
            $_SESSION['feedback_color'] = 'red';
        }
    } else {
        $_SESSION['feedback'] = 'De gegeven wachtwoorden komen niet overeen.';
        $_SESSION['feedback_color'] = 'red';
    }
    header('Location: home.php');
    exit(0);
}


include('presentation/Inlogformulier.php');

if (isset($_SESSION['feedback'])) {
    $feedback = new Feedback($_SESSION['feedback'], $_SESSION['feedback_color']);
    echo $feedback->getFeedback();
    unset($_SESSION['feedback']);
    unset($_SESSION['feedback_color']);
}
