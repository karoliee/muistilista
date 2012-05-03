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
                <h1>Käyttäjien poisto</h1></div>
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
                        echo "Käyttäjät ";
                        if (!empty($_POST['kayttaja'])) {
                            for ($i = 0; $i < count($_POST['kayttaja']); $i++) {
                                $poistettavakayttaja = $_POST['kayttaja'][$i];
                                $askaresql = "DELETE from askare where kayttaja='$poistettavakayttaja'";
                                $poistaminen = $yhteys->prepare($askaresql);
                                $poistaminen->execute();
                                $luokkasql = "DELETE from luokka where kayttaja='$poistettavakayttaja'";
                                $poistaminen = $yhteys->prepare($luokkasql);
                                $poistaminen->execute();
                                $kayttajasql = "DELETE from kayttaja where tunnus='$poistettavakayttaja'";
                                $poistaminen = $yhteys->prepare($kayttajasql);
                                $poistaminen->execute();
                                if ($i < count($_POST['kayttaja']) - 2) {
                                    echo $_POST['kayttaja'][$i] . ", ";
                                } else if ($i < count($_POST['kayttaja']) - 1) {
                                    echo $_POST['kayttaja'][$i] . " ja ";
                                } else {
                                    echo $_POST['kayttaja'][$i] . "";
                                }
                            }
                        }
                        echo " poistettiin.";
                        ?></td></tr></table>




        </div>


    </body>
</html>
