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
                <h1>Lisää askare</h1></div>
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
                        ?>
                        <form action="askareenlisays.php" method="post">
                            <p style="font-family:verdana;font-size:140%;color:black">

                            <p>Lisää muistilistallesi askare. Voit nimetä askareen ja kirjoittaa sille kuvauksen. Askareelle
                                voi myös antaa tärkeysasteen väliltä 1-5, jossa 1 ei ole tärkeä ja 5 on erittäin tärkeä. Voit lisätä 
                                askareelle myös eräpäivän. Kirjoita eräpäivä muodossa pv.kk.vvvv</p>
                            <p>Askareen nimi:
                                <input type="text" maxlength="50" name="askareennimi"></p>
                            <p>Tärkeysaste:
                                <select name="tarkeysaste">
                                    <option value="---">---</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option></select><br /></p>
                            <p>Eräpäivä:  <input type="text" name="erapaiva" size="10" maxlength="10"></p>
                            <p>Kuvaus: </p><p><textarea name="kuvaus" cols="40" rows="8"></textarea></p>
                            <input type="submit" value="Lisää askare muistilistalle"><input type="reset" value="Tyhjennä" />

                            <?php
                            if (isset($_POST['askareennimi'])) {
                                $askareennimi = $_POST["askareennimi"];
                                if ($_POST["tarkeysaste"] == "---") {
                                    $tarkeysaste = 0;
                                } else {
                                    $tarkeysaste = $_POST["tarkeysaste"];
                                }
                                $erapaiva = date('Y-m-d',strtotime($_POST['erapaiva']));
                                if ($erapaiva == "1970-01-01") {
                                    $erapaiva = null;
                                }

                                $kuvaus = $_POST["kuvaus"];
                                $lisays = $yhteys->prepare("INSERT INTO askare (tarkeysaste, askareennimi, erapaiva, kuvaus, kayttaja) VALUES (?, ?, ?, ?, ?)");
                                $lisays->execute(array($tarkeysaste, $askareennimi, $erapaiva, $kuvaus, $tunnus));
                                echo "Askare lisättiin muistilistalle.";
                            }
                            ?></td></tr></table>
