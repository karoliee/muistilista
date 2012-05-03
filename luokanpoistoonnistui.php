

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
                <h1>Luokan poisto</h1></div>
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
                        if (isset($_POST["kylla"])) {
                            $sql = "UPDATE askare set luokkanumero=null where kayttaja like '$tunnus' and luokkanumero=$luokkanumero";
                            $askaremuokkaus = $yhteys->prepare($sql);
                            $askaremuokkaus->execute();
                            
                            $poisto = $yhteys->prepare("DELETE FROM luokka where kayttaja like '$tunnus' and luokkanumero='$luokkanumero'");
                            $poisto->execute();
                            echo "Luokka poistettiin.";
                        } else if (isset($_POST["ei"])) {
                            header('Location: muistilista.php');
                        }
                        ?>
                    </td></tr></table>

        </div>


    </body>
</html>
