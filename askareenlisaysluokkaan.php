
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
                <h1>Askareen lisäys luokkaan</h1></div>
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
                        $options = "";
                        $sql = "SELECT luokannimi, luokkanumero FROM luokka where kayttaja like '$tunnus'";

                        $kysely = $yhteys->prepare($sql);
                        $kysely->execute();

                        while ($rivi = $kysely->fetch()) {
                            $luokkanumero = $rivi["luokkanumero"];
                            $luokannimi = $rivi["luokannimi"];
                            $options.="<OPTION VALUE=\"$luokkanumero\">".$luokannimi.'</option>';
                        }
                        ?>
                        <form action="askareenlisaysluokkaanonnistui.php" method="post">

                            <SELECT NAME="luokkanumero">
                                <OPTION VALUE=0>Valitse luokka, johon askare liitetään
                                    <?= $options ?>
                            </SELECT> 
                            <input type='hidden' name='askarenumero' value="<?php echo $askarenumero; ?>"/>
                            <input type="submit" value="Lisää askare luokkaan">
                            </td></tr></table>

                            </div>


                            </body>
                            </html>
