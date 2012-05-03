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
                <h1>Omien tietojen muuttaminen</h1></div>
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
                        $sahkopostiOnKaytetty = false;
                        $sahkopostiPakollinen = false;
                        $sahkopostiOnVaaranMuotoinen = false;
                        if (isset($_POST['sahkoposti'])) {
                            $sahkoposti = $_POST["sahkoposti"];
                            $kysely = $yhteys->prepare("SELECT sahkoposti FROM kayttaja where sahkoposti='$sahkoposti' and
                                    tunnus not like '$tunnus'");
                            $kysely->execute();
                            if ($kysely->fetch())
                                $sahkopostiOnKaytetty .= true;
                            if ($_POST['sahkoposti'] == null)
                                $sahkopostiPakollinen .= true;
                            if (!$_POST['sahkoposti'] == null & !filter_var($_POST['sahkoposti'], FILTER_VALIDATE_EMAIL))
                                $sahkopostiOnVaaranMuotoinen .= true;
                        }
                        ?>
                        <form action="tietojenmuutos.php" method="post">
                            <p style="font-family:verdana;font-size:140%;color:black">

                            <p>Yhteystietojen avulla pystymme tarvittaessa ottamaan yhteyttä käyttäjään esimerkiksi 
                                sopimusasioissa. Henkilö- ja yhteystietoja käsitellään henkilötietolain mukaan. 
                                <br>Anna voimassa oleva sähköpostiosoite. Tietoa tarvitaan mikäli unohdat salasanasi.</p>
                            <p>Etunimi:
                                <input type="text" maxlength="30" name="etunimi" value="<?php echo "" . $_SESSION['etunimi'] . ""; ?>"></p>
                            <p>Sukunimi:
                                <input type="text" maxlength="30" name="sukunimi" value="<?php echo "" . $_SESSION['sukunimi'] . ""; ?>"></p>
                            <p>Osoite:
                                <input type="text" maxlength="70" name="osoite" value="<?php echo "" . $_SESSION['osoite'] . ""; ?>"></p>
                            <p>Sähköposti:
                                <input type="text" maxlength="40" name="sahkoposti" size="30" value="<?php echo "" . $_SESSION['sahkoposti'] . ""; ?>"><b><?php
                        if ($sahkopostiPakollinen) {
                            echo "Sähköpostiosoite on pakollinen";
                        }
                        if ($sahkopostiOnVaaranMuotoinen) {
                            echo "Sähköpostiosoite ei ole kelvollinen";
                        }
                        if ($sahkopostiOnKaytetty) {
                            echo "Sähköpostiosoite on jo käytetty";
                        }
                        ?></b></p>
                            <input type="submit" value="Muuta tiedot">

                            <?php
                            if (!$sahkopostiOnKaytetty & !$sahkopostiOnVaaranMuotoinen & !$sahkopostiPakollinen &
                                    isset($_POST['sahkoposti'])) {
                                $etunimi = $_POST["etunimi"];
                                $sukunimi = $_POST["sukunimi"];
                                $osoite = $_POST["osoite"];
                                $paivitys = $yhteys->prepare("UPDATE kayttaja SET etunimi='$etunimi', sukunimi='$sukunimi',
                                            osoite='$osoite', sahkoposti='$sahkoposti' where tunnus='$tunnus'");
                                $paivitys->execute();
                                $_SESSION["sahkoposti"] = $sahkoposti;
                                $_SESSION["etunimi"] = $etunimi;
                                $_SESSION["sukunimi"] = $sukunimi;
                                $_SESSION["osoite"] = $osoite;
                                header("Location: tietojenmuutosonnistui.php");
                            }
                            ?></td></tr></table>

                            </div>


                            </body>
                            </html>

