
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
                <h1>Luokan muokkaaminen</h1></div>
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
                        $luokkanumero = $_GET["luokkanumero"];
                        $_SESSION["luokkanumero"] = $luokkanumero;
                        $tunnus = $_SESSION["tunnus"];
                        if (isset($_GET["Katso"])) {
                            header('Location: luokanaskareet.php');
                        }
                        $sql = "SELECT * FROM luokka where kayttaja like '$tunnus' and luokkanumero='$luokkanumero'";

                        $kysely = $yhteys->prepare($sql);
                        $kysely->execute();

                        $rivi = $kysely->fetch();
                        $luokannimi = $rivi["luokannimi"];
                        if (isset($_GET["Poista"])) {
                            $_SESSION["luokkanumero"] = $luokkanumero;
                            header('Location: luokanpoisto.php');
                        }
                        ?>
                        <form action="luokanmuokkausonnistui.php" method="post">
                            <p>Luokan nimi:
                                <input type="text" maxlength="50" name="luokannimi" value="<?php echo $luokannimi; ?>"></p>
                            <input type='hidden' name='luokkanumero' value="<?php echo $luokkanumero; ?>"/>
                            <input type="submit" value="Muuta luokan tiedot">
                            </td></tr></table>

                            </div>


                            </body>
                            </html>
