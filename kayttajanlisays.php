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
                <h1>Käyttäjän lisääminen</h1></div>
            <table>
                <tr valign="top">
                    <td style="width:200px;text-align:top;">
                        <b>Menu</b><br />
                        <a href=yllapito.php>Ylläpito</a><br />
                        <a href=yllapitajansalasananvaihto.php>Vaihda salasana</a><br />
                        <a href=kayttajanlisays.php>Lisää uusi käyttäjä</a><br />
                        <a href=uloskirjautuminen.php>Kirjaudu ulos</a>

                    </td><td style="background-color:lightseagreen;text-align:top;">
                        <?php
                        require("yhteys.php");
                        session_start();
                        $tunnusPakollinen = false;
                        $sahkopostiPakollinen = false;
                        $salasanaPakollinen = false;
                        $salasananVahvistusPakollinen = false;
                        $salasanatEivatTasmanneet = false;
                        $tunnusOnKaytetty = false;
                        $sahkopostiOnKaytetty = false;
                        $sahkopostiOnVaaranMuotoinen = false;
                        $tunnusOnLiianPitka = false;
                        $salasanaOnLiianPitka = false;

                        if (isset($_POST['tunnus'])) {
                            $tunnus = $_POST["tunnus"];
                            $kysely = $yhteys->prepare("SELECT tunnus FROM kayttaja where tunnus='$tunnus'");
                            $kysely->execute();
                            if ($kysely->fetch())
                                $tunnusOnKaytetty .= true;

                            $sahkoposti = $_POST["sahkoposti"];
                            $kysely = $yhteys->prepare("SELECT sahkoposti FROM kayttaja where sahkoposti='$sahkoposti'");
                            $kysely->execute();
                            if ($kysely->fetch())
                                $sahkopostiOnKaytetty .= true;

                            $salasana = $_POST["salasana"];
                            if ($_POST['tunnus'] == null)
                                $tunnusPakollinen .= true;
                            if ($_POST['sahkoposti'] == null)
                                $sahkopostiPakollinen .= true;
                            if ($_POST['salasana'] == null)
                                $salasanaPakollinen .= true;
                            if ($_POST['salasanavahvistus'] == null)
                                $salasananVahvistusPakollinen .= true;
                            if (!$_POST['salasana'] == null & !$_POST['salasanavahvistus'] == null & $_POST["salasana"] != $_POST["salasanavahvistus"])
                                $salasanatEivatTasmanneet .= true;
                            if (!$_POST['sahkoposti'] == null & !filter_var($_POST['sahkoposti'], FILTER_VALIDATE_EMAIL))
                                $sahkopostiOnVaaranMuotoinen .= true;
                            if (strlen($tunnus) > 30)
                                $tunnusOnLiianPitka .= true;
                            if (strlen($salasana) > 30)
                                $salasanaOnLiianPitka .= true;
                        }
                        ?>
                        <form action="kayttajanlisays.php" method="post">
                            <p>Käyttäjätunnus:
                                <input type="text" name="tunnus"><b><font color="red">*</font><?php
                        if ($tunnusPakollinen) {
                            echo "Käyttäjätunnus on pakollinen";
                        }
                        if ($tunnusOnKaytetty) {
                            echo "Käyttäjätunnus on jo varattu";
                        }
                        if ($tunnusOnLiianPitka) {
                            echo "Käyttäjätunnus on liian pitkä. Tunnus voi olla enintään 30 merkkiä pitkä";
                        }
                        ?></b></p> 
                            <p>Salasana:
                                <input type="password" name="salasana"><b><font color="red">*</font><?php
                                    if ($salasanaPakollinen) {
                                        echo "Salasana on pakollinen";
                                    }
                                    if ($salasanaOnLiianPitka) {
                                        echo "Salasana on liian pitkä. Salasana voi olla enintään 30 merkkiä pitkä";
                                    }
                        ?></b></p>
                            <p>Salasana uudestaan:
                                <input type="password" name="salasanavahvistus"><b><font color="red">*</font><?php
                                    if ($salasananVahvistusPakollinen) {
                                        echo "Salasana on kirjoitettava kahteen kertaan";
                                    }
                                    if ($salasanatEivatTasmanneet) {
                                        echo "Salasanat eivät täsmänneet";
                                    }
                        ?></b></p>
                            <p>Etunimi:
                                <input type="text" maxlength="30" name="etunimi"></p>
                            <p>Sukunimi:
                                <input type="text" maxlength="30" name="sukunimi"></p>
                            <p>Osoite:
                                <input type="text" maxlength="70" name="osoite"></p>
                            <p>Sähköposti:
                                <input type="text" maxlength="40" name="sahkoposti"><b><font color="red">*</font><?php
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
                            <input type="submit" value="Lisää käyttäjä"><input type="reset" value="Tyhjennä" /><p></p><br>
                            <?php
                            if (isset($_POST['tunnus'])) {
                                if (!$tunnusPakollinen & !$sahkopostiPakollinen & !$salasanaPakollinen &
                                        !$salasananVahvistusPakollinen & !$salasanatEivatTasmanneet & !$salasanaOnLiianPitka &
                                        !$tunnusOnKaytetty & !$sahkopostiOnKaytetty & !$tunnusOnLiianPitka &
                                        !$sahkopostiOnVaaranMuotoinen) {
                                    $lisays = $yhteys->prepare("INSERT INTO kayttaja (tunnus, salasana, sahkoposti, etunimi, sukunimi,
    osoite) VALUES (?, ?, ?, ?, ?, ?)");
                                    $lisays->execute(array($_POST["tunnus"], $_POST["salasana"], $_POST["sahkoposti"], $_POST["etunimi"]
                                        , $_POST["sukunimi"], $_POST["osoite"]));
                                    echo "Käyttäjän lisääminen onnistui.";
                                }
                            }
                            ?></td></tr></table>




                            </div>


                            </body>
                            </html>