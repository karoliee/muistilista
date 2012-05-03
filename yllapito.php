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
                <h1>Muistilistan ylläpito</h1></div>
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
                        $kayttajasql = "SELECT * FROM kayttaja where tunnus not like 'yllapitaja' order by tunnus";

                        $kayttajakysely = $yhteys->prepare($kayttajasql);
                        $kayttajakysely->execute();

                        echo "<table border><tr><td> </td><td>Tunnus </td><td>Etunimi </td>
                            <td>Sukunimi </td><td>Osoite </td><td>Sähköposti </td>
                            </tr><form action='kayttajienpoisto.php' method='post'>";

                        while ($rivi = $kayttajakysely->fetch()) {
                            $kayttaja = $rivi["tunnus"];
                            echo "<tr><td><input type='checkbox' name='kayttaja[]' value='$kayttaja'/></td>
                                <td>" . $kayttaja . "</td><td>" . $rivi["etunimi"] . "</td>
                                    <td>" . $rivi["sukunimi"] . "</td><td>" . $rivi["osoite"] . "</td>
                                        <td>" . $rivi["sahkoposti"] . "</td></tr>";
                        }
                        echo "</table><p></p><input type='submit' name='Poista'
                            value='Poista valitut käyttäjät'/></fieldset>";
                        ?></td></tr></table>




        </div>


    </body>
</html>
