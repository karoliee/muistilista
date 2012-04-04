
<?php

try {
    $yhteys = new PDO("pgsql:host=localhost;dbname=karoliee",
                    "karoliee", "257c0109f7f6dcbd");
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$virheilmoitus = "";
$toinenVirheilmoitus = "";
$varattuilmoitus = "";
$kysely = $yhteys->prepare("SELECT * FROM kayttaja");
$kysely->execute();
while ($rivi = $kysely->fetch()) {
    if ($_POST["tunnus"] == $rivi["tunnus"])
        $varattuilmoitus .= "<p>Käyttäjätunnus on jo varattu <br>";
    if ($_POST["sahkoposti"] == $rivi["sahkoposti"])
        $varattuilmoitus .= "<p>Sähköpostiosoite on jo käytetty <br>";
}
if ($_POST['tunnus'] == null)
    $virheilmoitus .= "<p>Käyttäjätunnus on pakollinen<br>";
if ($_POST['sahkoposti'] == null)
    $virheilmoitus .= "<p>Sähköpostiosoite on pakollinen<br>";
if ($_POST['salasana'] == null)
    $toinenVirheilmoitus .= "<p>Salasana on pakollinen<br>";
if ($_POST['salasanavahvistus'] == null)
    $toinenVirheilmoitus .= "<p>Salasana on kirjoitettava kahteen kertaan<br>";
if ($_POST["salasana"] != $_POST["salasanavahvistus"])
    $toinenVirheilmoitus .= "<p>Salasanat eivät täsmänneet <br>";
if ($virheilmoitus != "") {
    echo "<br><p><big><b>Rekisteröityminen epäonnistui.</b> Lue ohjeet tarkasti ja yritä uudelleen.</big></p>
            <hr />";
    echo $virheilmoitus;
    echo "<hr /><p><a href=\"javascript:history.back();\">Palaa täyttämään lomake loppuun</a>";
    exit;
} else if ($varattuilmoitus != "") {
    echo "<br><p><big><b>Rekisteröityminen epäonnistui.</b> Lue ohjeet tarkasti ja yritä uudelleen.</big></p>
            <hr />";
    echo $varattuilmoitus;
    echo "<hr /><p><a href=\"javascript:history.back();\">Palaa täyttämään lomake loppuun</a>";
    exit;
} else if (!filter_var($_POST['sahkoposti'], FILTER_VALIDATE_EMAIL)) {
    echo "<br><p><big><b>Rekisteröityminen epäonnistui.</b> Lue ohjeet tarkasti ja yritä uudelleen.</big></p>
            <hr />Sähköpostiosoite ei ole kelvollinen<hr /><p><a href=\"javascript:history.back();\">
            Palaa täyttämään lomake loppuun</a>";
    exit;
} else if ($toinenVirheilmoitus != "") {
    echo "<br><p><big><b>Rekisteröityminen epäonnistui.</b> Lue ohjeet tarkasti ja yritä uudelleen.</big></p>
            <hr />";
    echo $toinenVirheilmoitus;
    echo "<hr /><p><a href=\"javascript:history.back();\">Palaa täyttämään lomake loppuun</a>";
    exit;
} else {
    $lisays = $yhteys->prepare("INSERT INTO kayttaja (tunnus, salasana, sahkoposti, etunimi, sukunimi,
    osoite) VALUES (?, ?, ?, ?, ?, ?)");
    $lisays->execute(array($_POST["tunnus"], $_POST["salasana"], $_POST["sahkoposti"], $_POST["etunimi"]
        , $_POST["sukunimi"], $_POST["osoite"]));
    echo "<br><p><big><b>Rekisteröityminen onnistui.</b></big> <br>Tunnuksesi palveluun on ";
    echo $_POST["tunnus"];
    echo "<br>Pääset kirjautumaan palveluun <a href=index.php>tästä</a>";
}
?>


