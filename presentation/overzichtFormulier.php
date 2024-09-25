<?php

declare(strict_types=1);

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjesbar overzicht</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<body id="bodyOverzicht">
    <!--START WRAPPER-->
    <div class="wrapper">
        <h2>Welkom,
            <?php echo ucfirst(unserialize($_COOKIE['user'], ['User'])->getUsername()) . ' ' ?><a href="home.php?action=loguit">Uitloggen</a>
        </h2>
        <p id="feedback"></p>
        <h1>Overzichtformulier</h1>
        <div class="scroller">
            <table id="besteldeBroodjes">
                <thead>
                    <tr>
                        <th>Broodje</th>
                        <th>klant ID</th>
                        <th>Klant Naam</th>
                        <th>Tijdstip bestelling</th>
                        <th>Prijs</th>
                        <th>Afwerken</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($lijst_bestellingen as $bestelling) {
                        echo
                        '
                    <tr>
                        <td>' . $broodjeSvc->getBroodjeById($bestelling->getBroodjeId())->getNaam() . '</td>
                        <td>' . $bestelling->getKlantId() . '</td>
                        <td>' . $userSvc->getUserById($bestelling->getKlantId())->getUsername() . '</td>
                        <td>' . $bestelling->getDatumBestelling() . '</td>
                        <td>€' . $broodjeSvc->getBroodjeById($bestelling->getBroodjeId())->getPrijs() . '</td>
                        <td>' . $bestelSvc->getBestellingToestandAction($bestelling) . '</td>
                    </tr>
                    ';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h1>Gebruikers</h1>
        <div class="scroller">
            <table id="gebruikers">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Soort</th>
                        <th>Toestand</th>
                    </tr>
                </thead>
                <?php


                foreach ($lijst_users as $user) {

                    echo
                    '
                    <tr>
                        <td>' . $user->getId() . '</td>
                        <td>' . $user->getUsername() . '</td>
                        <td>' . $user->getEmail() . '</td>
                        <td>' . $user->getSoort() . '</td>
                        <td>' . $userSvc->getUserToestandAction($user) . '</td>
                    </tr>
                    ';
                }
                ?>
            </table>

        </div>
    </div>
    <!--EINDE WRAPPER-->

</body>

</html>