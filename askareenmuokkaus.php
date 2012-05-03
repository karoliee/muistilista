
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
                <h1>Askareen muokkaaminen</h1></div>
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
                        $askarenumero = $_GET["askarenumero"];
                        $tunnus = $_SESSION["tunnus"];
                        $sql = "SELECT * FROM askare where kayttaja like '$tunnus' and askarenumero='$askarenumero'";

                        $kysely = $yhteys->prepare($sql);
                        $kysely->execute();

                        $rivi = $kysely->fetch();
                        $askareennimi = $rivi["askareennimi"];
                        $tarkeysaste = $rivi["tarkeysaste"];
                        if ($tarkeysaste == "0") {
                            $tarkeysaste = '---';
                        }
                        $erapaiva = $rivi["erapaiva"];
                        $erapaiva = date("d.m.Y", strtotime($erapaiva));
                        if ($erapaiva == "01.01.1970") {
                            $erapaiva = null;
                        }
                        $kuvaus = $rivi["kuvaus"];
                        $poistetaan = false;
                        $lisataan = false;
                        $poistetaanluokasta = false;
                        $_SESSION["askarenumero"] = $askarenumero;
                        if (isset($_GET["Poista"])) {
                            $poistetaan = true;
                        }
                        if (isset($_GET["Luokita"])) {
                            $lisataan = true;
                        }
                        if (isset($_GET["Luokaton"])) {
                            $poistetaanluokasta = true;
                        }
                        if ($poistetaan) {
                            header('Location: askareenpoisto.php');
                        }
                        if ($lisataan) {
                            header('Location: askareenlisaysluokkaan.php');
                        }
                        if ($poistetaanluokasta) {
                            header('Location: askareenpoistoluokasta.php');
                        }
                        ?>
                        <form action="askareenmuutosonnistui.php" method="post">
                            <p>Askareen nimi:
                                <input type="text" maxlength="50" name="askareennimi" value="<?php echo $askareennimi; ?>"></p>
                            <p>Tärkeysaste:
                                <select name="tarkeysaste">
                                    <option value="---" <?php
                        if ($tarkeysaste == "---") {
                            echo "selected";
                        }
                        ?>>---</option><option value="5" <?php
                                            if ($tarkeysaste == "5") {
                                                echo "selected";
                                            }
                        ?>>5</option>
                                    <option value="4" <?php
                                            if ($tarkeysaste == "4") {
                                                echo "selected";
                                            }
                        ?>>4</option>
                                    <option value="3" <?php
                                            if ($tarkeysaste == "3") {
                                                echo "selected";
                                            }
                        ?>>3</option>
                                    <option value="2" <?php
                                            if ($tarkeysaste == "2") {
                                                echo "selected";
                                            }
                        ?>>2</option>
                                    <option value="1" <?php
                                            if ($tarkeysaste == "1") {
                                                echo "selected";
                                            }
                        ?>>1</option></select><br /></p>
                            <p>Eräpäivä:  <input type="text" name="erapaiva" value="<?php echo $erapaiva; ?>" size="10" maxlength="10"><?php echo " Muistathan kirjoittaa eräpäivän muodossa pv.kk.vvvv"; ?></p>
                            <p>Kuvaus: </p><p><textarea name="kuvaus" cols="40" rows="8"><?php echo $kuvaus; ?></textarea></p>
                            <input type='hidden' name='askarenumero' value="<?php echo $askarenumero; ?>"/>
                            <input type="submit" value="Muuta askareen tiedot">
                            </td></tr></table>

                            </div>


                            </body>
                            </html>
