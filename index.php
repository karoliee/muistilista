<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>Sisäänkirjautuminen</h1>
        <p>Tervetuloa käyttämään muistilistaa! Muistilistan avulla voit pitää listaa muistettavista 
            askareistasi.</p>
        <form action="sisaankirjautuminen.php" method="post">
            <fieldset style="width:500px">
                <p>Käyttäjätunnus <input type="text" name="tunnus"></p>
                <p>Salasana <input type="password" name="salasana"></p>
                <input type="submit" value="OK">
            </fieldset>
        </form>

        <?php
        echo "<br><a href=salasanaHukkunut.html>Unohtuiko salasanasi?</a>
            <br><p>Eikö sinulla ole käyttäjätunnusta muistilistaan? Rekisteröidy palvelun käyttäjäksi - 
            se ei maksa mitään, ja saat muistilistan käyttöösi heti.</p>
            <a href=rekisteroityminen.html>Rekisteröidy käyttäjäksi tästä</a>";
        ?> 
    </body>
</html>
