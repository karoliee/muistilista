

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
                <h1>Askareen poisto</h1></div>
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
                        if (empty($_POST["ei"])) {
                            $poisto = $yhteys->prepare("DELETE FROM askare where kayttaja like '$tunnus' and askarenumero='$askarenumero'");
                            $poisto->execute();
                            echo "Askare poistettiin.";
                        } else if (empty($_POST["kylla"])) {
                            header('Location: muistilista.php');
                        }
                        ?>
                    </td></tr></table>

        </div>


    </body>
</html>
