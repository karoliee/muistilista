<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body
        link="orange" vlink="orange">
        <div id="container">

            <div id="header">
                <h1>Lisää luokka</h1></div>
            <table>
                <tr valign="top">
                    <td style="width:200px;text-align:top;">
                        <b>Menu</b><br />
                        <a href=muistilista.php>Oma muistilista</a><br />
                        <a href=tietojenmuutos.php>Muuta tietoja</a><br />
                        <a href=salasananvaihto.php>Vaihda salasana</a><br />
                        <a href=uloskirjautuminen.php>Kirjaudu ulos</a>

                    </td><td style="background-color:lightseagreen;width:800px;text-align:top;">
                        <?php
                        require("yhteys.php");
                        session_start();
                        ?>
                        <form action="luokanlisays.php" method="post">
                            <p style="font-family:verdana;font-size:140%;color:black">

                            <p>Lisää muistilistallesi luokka, johon voit lisätä askareita.</p>
                            <p>Luokan nimi:
                                <input type="text" maxlength="50" name="luokannimi"></p>
                            <input type="submit" value="Lisää luokka muistilistalle"><input type="reset" value="Tyhjennä" />

                            <?php
                            if (isset($_POST['luokannimi'])) {
                                $luokannimi = $_POST["luokannimi"];
                                $tunnus = $_SESSION["tunnus"];
                                $lisays = $yhteys->prepare("INSERT INTO luokka (luokannimi, kayttaja) VALUES (?, ?)");
                                $lisays->execute(array($luokannimi, $tunnus));
                                echo "Luokka lisättiin muistilistalle.";
                            }
                            ?></td></tr></table>

        </div>

    </body>
</html>

