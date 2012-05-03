<?php

require("yhteys.php");
session_start();
unset($_SESSION["tunnus"]);
header("Location: sisaankirjautuminen.php");
?>
