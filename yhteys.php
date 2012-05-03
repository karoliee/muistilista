<?php
        try {
            $yhteys = new PDO("pgsql:host=localhost;dbname=karoliee",
                            "karoliee", "257c0109f7f6dcbd");
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
