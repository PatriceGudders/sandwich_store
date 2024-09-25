<?php

declare(strict_types=1);

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $toestand;
    private $soort;

    public function __construct(int $id, string $username, string $email, string $password, string $toestand, string $soort)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->toestand = $toestand;
        $this->soort = $soort;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getToestand()
    {
        return $this->toestand;
    }

    public function getSoort()
    {
        return $this->soort;
    }
}
