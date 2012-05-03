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
                <h1>Salasanan vaihto</h1></div>
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
                        $tunnus = $_SESSION["tunnus"];
                        $salasananVahvistusPakollinen = false;
                        $salasanatEivatTasmanneet = false;
                        $salasanaOnLiianPitka = false;
                        if (isset($_POST['salasana'])) {
                            $salasana = $_POST["salasana"];
                            if ($_POST['salasanavahvistus'] == null)
                                $salasananVahvistusPakollinen .= true;
                            if (!$_POST['salasana'] == null & !$_POST['salasanavahvistus'] == null & $_POST["salasana"] != $_POST["salasanavahvistus"])
                                $salasanatEivatTasmanneet .= true;
                            if (strlen($salasana) > 30)
                                $salasanaOnLiianPitka .= true;
                        }
                        ?>
                        <form action="salasananvaihto.php" method="post">
                            <p style="font-family:verdana;font-size:140%;color:black">

                            <p>Säilytä salasanasi huolellisesti - näin estät tietojesi joutumisen vääriin käsiin.
                                Salasana on hyvä vaihtaa ajoittain.</p>
                            <p>Salasana:
                                <input type="password" name="salasana"><b><?php
                        if ($salasanaOnLiianPitka) {
                            echo "Salasana on liian pitkä. Salasana voi olla enintään 30 merkkiä pitkä";
                        }
                        ?></b></p>
                            <p>Salasana uudestaan:
                                <input type="password" name="salasanavahvistus"><b><?php
                                    if ($salasananVahvistusPakollinen) {
                                        echo "Salasana on kirjoitettava kahteen kertaan";
                                    }
                                    if ($salasanatEivatTasmanneet) {
                                        echo "Salasanat eivät täsmänneet";
                                    }
                        ?></b></p>

                            <input type="submit" value="Vaihda salasana">

                            <?php
                            if (!$salasananVahvistusPakollinen & !$salasanatEivatTasmanneet & !$salasanaOnLiianPitka &
                                    isset($_POST['salasana'])) {
                                $paivitys = $yhteys->prepare("UPDATE kayttaja SET salasana='$salasana' where tunnus='$tunnus'");
                                $paivitys->execute();
                                $_SESSION["salasana"] = $salasana;
                                echo "<p></p>Salasanan vaihto onnistui.";
                            }
                            ?> 

                            </td></tr></table>

                            </div>


                            </body>
                            </html>

