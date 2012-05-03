
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
                        $tunnus = $_SESSION["tunnus"];
                        $askareennimi = $_POST["askareennimi"];
                        if ($_POST["tarkeysaste"] == "---") {
                            $tarkeysaste = 0;
                        } else {
                            $tarkeysaste = $_POST["tarkeysaste"];
                        }
                        $erapaiva = date('Y-m-d', strtotime($_POST["erapaiva"]));
                        if ($erapaiva == "1970-01-01") {
                            $erapaiva = null;
                        }

                        $kuvaus = $_POST["kuvaus"];
                        $askarenumero = $_POST["askarenumero"];
                        if ($erapaiva != null) {
                            $paivitys = $yhteys->prepare("UPDATE askare SET askareennimi='$askareennimi', tarkeysaste='$tarkeysaste',
                                            erapaiva='$erapaiva', kuvaus='$kuvaus' where kayttaja like '$tunnus' and askarenumero='$askarenumero'");
                        } else {
                            $paivitys = $yhteys->prepare("UPDATE askare SET askareennimi='$askareennimi', tarkeysaste='$tarkeysaste',
                                            erapaiva=null, kuvaus='$kuvaus' where kayttaja like '$tunnus' and askarenumero='$askarenumero'");
                        }
                        $paivitys->execute();
                        echo "Askareen tiedot muutettiin.";
                        ?></td></tr></table>
        </div>


    </body>
</html>