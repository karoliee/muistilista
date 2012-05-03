<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body
        link="orange" vlink="orange">
        <?php
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
        require("yhteys.php");

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
        <form action="rekisteroityminen.php" method="post">
            <p>
                Tervetuloa käyttämään elektronista muistilistaa. Saat muistilistan käyttöösi rekisteröitymällä
                palveluun. Rekisteröityminen ja palvelun käyttäminen on ilmaista. 
            </p><font color="red">*Tähdellä merkityt tiedot ovat pakollisia.</font><p></p>
            <hr />
            <p>Valitse käyttäjätunnus ja salasana. Näillä tunnuksilla pääset kirjautumaan palveluun. 
                Käyttäjätunnusta ei voi muuttaa enää myöhemmin, mutta
                salasanan voi. <br>Säilytä salasanasi huolellisesti - näin estät tietojesi joutumisen vääriin 
                käsiin. Isot ja pienet kirjaimet ovat merkityksellisiä (eli matti ei ole sama kuin MATTI).</p>
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
            <hr />
            <p>Yhteystietojen avulla pystymme tarvittaessa ottamaan yhteyttä käyttäjään esimerkiksi 
                sopimusasioissa. Henkilö- ja yhteystietoja käsitellään henkilötietolain mukaan. 
                <br>Anna voimassa oleva sähköpostiosoite. Tietoa tarvitaan mikäli unohdat salasanasi.</p>
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
            <hr />
            <input type="submit" value="Rekisteröi tiedot"><input type="reset" value="Tyhjennä" /><p></p><br>
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
                    echo "Rekisteröityminen onnistui, tunnuksesi palveluun on ";
                    echo $_POST["tunnus"];
                }
            }
            echo "<br /><a href=sisaankirjautuminen.php>Palaa sisäänkirjautumiseen</a>";
            ?>
        </form>
    </body>
</html>


