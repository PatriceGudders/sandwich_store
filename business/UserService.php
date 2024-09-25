<?php

declare(strict_types=1);
require_once('data/autoloader.php');
class UserService
{
    public function getUsers(): array
    {
        $userDAO = new UserDAO();
        $lijst = $userDAO->getAll();
        return $lijst;
    }

    public function getUserById(int $id): ?User
    {
        $lijst_users = $this->getUsers();
        foreach ($lijst_users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
    }

    public function getUserByEmail(string $email): ?User
    {

        $lijst_users = $this->getUsers();
        foreach ($lijst_users as $user) {
            if ($user->getEmail() === strtolower($email)) {
                return $user;
            }
        }
    }

    public function addUser(string $naam, string $email, string $wachtwoord)
    {
        $userDAO = new UserDAO();
        $userDAO->addUser($naam, $email, $wachtwoord);
    }

    public function blockUser(User $user)
    {
        $userDAO = new UserDAO();
        $userDAO->blockUser($user);
    }

    public function unblockUser(User $user)
    {
        $userDAO = new UserDAO();
        $userDAO->unblockUser($user);
    }

    public function validateUser(string $user_email, string $user_password): bool
    {
        $userDAO = new UserDAO();
        $user = $userDAO->validateUser($user_email, $user_password);
        if (($user !== null) && ($user->getToestand() !== 'geblokkeerd')) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePasswordRepetition(string $password, string $password2): bool
    {
        if ($password === $password2) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail(string $email): bool
    {
        //Gebruik de ingebouwde functie om het formaat van een email adres te valideren
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        //Controleer als het email adres al bestaat in de database
        $alreadyExists = true;
        $lijst_users = $this->getUsers();
        foreach ($lijst_users as $user) {
            if ($user->getEmail() === $email) {
                $alreadyExists = false;
            }
        }

        return $alreadyExists;
    }

    //Geef de correcte link (blokkeren/activeren/niets) terug op basis van de user data
    public function getUserToestandAction(User $user): string
    {
        $string_toestand = 'actief';

        if (($user->getToestand() == 'actief') && ($user->getSoort() !== 'medewerker')) {
            $string_toestand = 'actief <a href="overzicht.php?blokkeer_id=' . $user->getId() . '">(Blokkeren)</a>';
        } elseif (($user->getToestand() == 'geblokkeerd') && ($user->getSoort() !== 'medewerker')) {
            $string_toestand = 'geblokkeerd <a href="overzicht.php?activeer_id=' . $user->getId() . '">(Activeren)</a>';
        }
        return $string_toestand;
    }
}
