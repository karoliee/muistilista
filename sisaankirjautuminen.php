<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body
        link="orange" vlink="orange">
        <?php
        require("yhteys.php");
        if (isset($_POST['tunnus'])) {
            $tunnus = $_POST["tunnus"];
            $salasana = $_POST["salasana"];
            $kysely = $yhteys->prepare("SELECT tunnus, salasana FROM kayttaja where tunnus='$tunnus' and 
                    salasana='$salasana'");
            $kysely->execute();
            if ($kysely->fetch()) {
                session_start();
                $_SESSION["tunnus"] = $tunnus;
                $kysely = $yhteys->prepare("SELECT * FROM kayttaja where tunnus='$tunnus'");
                $kysely->execute();
                $rivi = $kysely->fetch();
                $_SESSION["salasana"] = $rivi["salasana"];
                $_SESSION["sahkoposti"] = $rivi["sahkoposti"];
                $_SESSION["etunimi"] = $rivi["etunimi"];
                $_SESSION["sukunimi"] = $rivi["sukunimi"];
                $_SESSION["osoite"] = $rivi["osoite"];
                header("Location: muistilista.php");
            }
        }
        ?>
        <h1>Sisäänkirjautuminen</h1>
        <p>Tervetuloa käyttämään muistilistaa! Muistilistan avulla voit pitää listaa muistettavista 
            askareistasi.</p>
        <form action="sisaankirjautuminen.php" method="post">
            <fieldset style="width:500px">
                <p>Käyttäjätunnus <input type="text" name="tunnus"></p>
                <p>Salasana <input type="password" name="salasana"></p>
                <input type="submit" value="OK">
            </fieldset>
        </form>

        <?php
        echo "<br><a href=hukkunutsalasana.php>Unohtuiko salasanasi?</a>
            <br><p>Eikö sinulla ole käyttäjätunnusta muistilistaan? Rekisteröidy palvelun käyttäjäksi - 
            se ei maksa mitään, ja saat muistilistan käyttöösi heti.</p>
            <a href=rekisteroityminen.php>Rekisteröidy käyttäjäksi!</a>
            <p></p><a href=sisaankirjautuminenyllapitoon.php>Kirjaudu ylläpitoon</a>";
        ?> <b><font color="red"> <?php
        if (isset($_POST['tunnus'])) {
            echo "<p>Sisäänkirjautuminen epäonnistui. Tarkista syöttämäsi tunnus ja salasana
                ja yritä uudelleen.</p>";
        }
        ?> </font></b>
    </body>
</html>