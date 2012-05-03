
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body
        link="orange" vlink="orange">
        <h1>Unohtuiko salasanasi?</h1>
        <p>Jos unohdit salasanasi tai käyttäjätunnuksesi, syötä tähän rekisteröityessäsi antamasi sähköpostiosoite, niin lähetämme sinulle salasanan ja käyttäjätunnuksen
            sähköpostiisi.</p>
        <form action="hukkunutsalasana.php" method="post">
            <fieldset style="width:500px">
                <p>Sähköpostiosoitteesi <input type="text" name="sahkoposti"></p>
                <input type="submit" value="OK">
            </fieldset>
        </form>
        <?php
        require("yhteys.php");
        $sahkoposti = $_POST["sahkoposti"];
        $kysely = $yhteys->prepare("SELECT tunnus, salasana, sahkoposti FROM kayttaja where sahkoposti='$sahkoposti'");
        $kysely->execute();
        $rivi = $kysely->fetch();
        if ($rivi) {
            $tunnusJaSahkoPostiLoydettiin .= true;
            $tunnus = $rivi["tunnus"];
            $salasana = $rivi["salasana"];
            $to = $rivi["sahkoposti"];
            $subject = "Salasana ja käyttäjätunnus palveluun";
            $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";
            $message = "Hei!
                Tässä ovat pyytämäsi tunnus ja salasana, joita tarvitset kirjautuaksesi muistilistaan.
                
                Tunnus: $tunnus
                Salasana: $salasana
                
                Huomaathan, ettet voi vastata tähän viestiin!";
            $from = "noreply@muistilista.com";
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);
            echo "<p>Salasana ja käyttäjätunnus lähetettiin sähköpostiosoitteeseen.</p>";
        }
        if (!$tunnusJaSahkoPostiLoydettiin & isset($_POST['sahkoposti'])) {
            echo "<p>Salasanan lähetys epäonnistui. Tarkista syöttämäsi sähköpostiosoite
                ja yritä uudelleen. Tai ota yhteyttä asiakaspalveluun.</p>";
        }
        echo "<br><p><a href=sisaankirjautuminen.php>Palaa sisäänkirjautumiseen</a></p>";
        ?> 
    </body>
</html>