<?php

function conectar() {
    try {
        $dbh = new PDO("pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres");
        return $dbh;
    } catch (Exception $e) {
          echo $e->getMessage();
    }
}
?>

