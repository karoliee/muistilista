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
                <h1>Askareen poisto luokasta</h1></div>
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
                        $askarenumero = $_SESSION["askarenumero"];
                        $tunnus = $_SESSION["tunnus"];
                        $sql = "UPDATE askare set luokkanumero=null where kayttaja like '$tunnus' and askarenumero=$askarenumero";

                        $muokkaus = $yhteys->prepare($sql);
                        $muokkaus->execute();
                        echo "Askare poistettiin luokasta.";
                        ?>
                    </td></tr></table>

        </div>


    </body>
</html>
