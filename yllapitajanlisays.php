<?php

require("yhteys.php");
$yllapitajasql = "SELECT * FROM kayttaja where tunnus like 'yllapitaja'";
$kysely = $yhteys->prepare($yllapitajasql);
$kysely->execute();
$rivi = $kysely->fetch();
if ($rivi == null) {
    $lisays = $yhteys->prepare("INSERT INTO kayttaja (tunnus, salasana, sahkoposti) VALUES (?, ?, ?)");
    $lisays->execute(array('yllapitaja', 'salasana', 'noreply@muistilista.fi'));
}
?>
