<?php

declare(strict_types=1);

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjesbar Bestellen</title>
    <link rel="stylesheet" href="Css/default.css">
</head>

<body id="bodyBestel">
    <!--START WRAPPER-->
    <div class="wrapper">
        <h2>Welkom,
            <?php echo ucfirst(unserialize($_COOKIE['user'], ['User'])->getUsername()) . ' ' ?><a href="home.php?action=loguit">Uitloggen</a>
        </h2>
        <p id="feedback"></p>
        <h1 class="titel">Bestelformulier</h1>
        <table id="broodjesInfo">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Prijs</th>
                    <th>Bestellen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lijst_broodjes as $broodje) {
                    echo
                    '
                <tr>
                    <td>' . $broodje->getNaam() . '</td>
                    <td>' . $broodje->getOmschrijving() . '</td>
                    <td>€' . $broodje->getPrijs() . '</td>
                    <td><a href="bestellen.php?action=bestel&id_broodje=' . $broodje->getId() . '">Bestel ></a></td>
                </tr>
                ';
                }
                ?>
            </tbody>
        </table>

    </div>
    <!--END WRAPPER-->

</body>

</html>