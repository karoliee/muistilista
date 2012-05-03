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
                <h1>Luokan askareet</h1></div>
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
                        $luokkanumero = $_SESSION["luokkanumero"];
                        $tunnus = $_SESSION["tunnus"];
                        $askaresql = "SELECT * FROM askare where kayttaja like '$tunnus' and luokkanumero=$luokkanumero order by tarkeysaste desc, erapaiva asc, askareennimi asc";
                        $askarekysely = $yhteys->prepare($askaresql);
                        $askarekysely->execute();

                        while ($rivi = $askarekysely->fetch()) {
                            $askarenumero = $rivi["askarenumero"];
                            $askareennimi = $rivi["askareennimi"];
                            $tarkeysaste = $rivi["tarkeysaste"];
                            if ($tarkeysaste == "0") {
                                $tarkeysaste = null;
                            }
                            $erapaiva = $rivi["erapaiva"];
                            $erapaiva = date("d.m.Y", strtotime($erapaiva));
                            if ($erapaiva == "01.01.1970") {
                                $erapaiva = null;
                            }
                            $kuvaus = $rivi["kuvaus"];
                            $newtext = wordwrap($kuvaus, 50, "<br />\n", true);
                            $luomispaiva = $rivi["luomispaiva"];
                            $luomispaiva = date("d.m.Y", strtotime($luomispaiva));
                            echo "<form action='askareenmuokkaus.php' method='get'>
                                <fieldset style='width:775px;'><b>Askare: </b>$askareennimi<br/>
                            <b>Tärkeys: </b>$tarkeysaste<br/><b>Kuvaus: </b>";
                            echo $newtext;
                            echo "<br/><b>Eräpäivä: </b>$erapaiva<br/><b>Tehty: </b>$luomispaiva<br/>
                            <p></p><input type='hidden' name='askarenumero' value='$askarenumero'/><input type='submit' 
                            name='Muokkaa' value='Muokkaa askaretta'/><input type='submit' name='Poista'
                            value='Poista askare'/><input type='submit' name='Luokaton'
                            value='Poista askare luokasta'/></fieldset></form><p></p>";
                        }
                        ?>
                    </td></tr></table>

        </div>


    </body>
</html>

