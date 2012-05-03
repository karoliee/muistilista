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
            require("yllapitajanlisays.php");
            
            if (isset($_POST['tunnus'])) {
                $tunnus = $_POST["tunnus"];
                $salasana = $_POST["salasana"];
                $kysely = $yhteys->prepare("SELECT tunnus, salasana FROM kayttaja where tunnus='$tunnus' and 
                    salasana='$salasana'");
                $kysely->execute();
                if ($kysely->fetch() & $tunnus == 'yllapitaja') {
                    session_start();
                    $_SESSION["tunnus"] = $tunnus;
                    $kysely = $yhteys->prepare("SELECT * FROM kayttaja where tunnus='$tunnus'");
                    $kysely->execute();
                    $rivi = $kysely->fetch();
                    $_SESSION["salasana"] = $rivi["salasana"];
                    header("Location: yllapito.php");
                }
            }
            ?>
        <h1>Sisäänkirjautuminen ylläpitoon</h1>
        <form action="sisaankirjautuminenyllapitoon.php" method="post">
            <fieldset style="width:500px">
                <p>Käyttäjätunnus <input type="text" name="tunnus"></p>
                <p>Salasana <input type="password" name="salasana"></p>
                <input type="submit" value="OK">
            </fieldset>
        </form>

        <?php
        echo "<br><a href=sisaankirjautuminen.php>Palaa aloitussivulle</a>";
        ?> <b><font color="red"> <?php
        if (isset($_POST['tunnus'])) {
            echo "<p>Sisäänkirjautuminen epäonnistui. Tarkista syöttämäsi tunnus ja salasana
                ja yritä uudelleen.</p>";
        }
        ?></font></b>
    </body>
</html>