<?php

declare(strict_types=1);

?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjesbar Login</title>
    <link rel="stylesheet" href="Css/default.css">
</head>

<body id="bodyInlog">
    <!--START WRAPPER-->
    <div class="wrapper">
        <h1 class="titel">DE BROODJESBAR</h1>
        <p id="feedback"></p>
        <form method="post" id="login" action="home.php?action=login">

            <h1>LOG IN</h1>

            <label for="log_email">Email adres</label>
            <input type="text" id="log_email" name="log_email" placeholder="Je email.." required maxlength="50">

            <br>

            <label for="log_password">Wachtwoord</label>
            <input type="password" id="log_password" name="log_password" placeholder="Je wachtwoord.." required
                maxlength="50" minlength="8">

            <br>

            <input type="submit" value="Log in!" class="button">

        </form>



        <form method="post" id="register" action="home.php?action=register">

            <h1>REGISTREER</h1>

            <label for="reg_username">Naam</label>
            <input type="text" id="reg_username" name="reg_username" placeholder="Je naam.." required maxlength="45">

            <br>

            <label for="reg_email">Email adres</label>
            <input type="email" id="reg_email" name="reg_email" placeholder="Je email.." required maxlength="50">

            <br>

            <label for="reg_password">Wachtwoord</label>
            <input type="password" id="reg_password" name="reg_password" placeholder="Je wachtwoord.." required
                maxlength="50" minlength="8">

            <br>

            <label for="reg_password2">Geef je wachtwoord opnieuw in</label>
            <input type="password" id="reg_password2" name="reg_password2" placeholder="Je wachtwoord.." required
                maxlength="50" minlength="8">

            <br>

            <input type="submit" value="Registreer!" class="button">

        </form>



    </div>
    <!--END WRAPPER-->

</body>

</html>