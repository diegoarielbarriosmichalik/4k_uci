<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_editorial) FROM editorial';
foreach ($con->query($sql) as $row) {
    $id_autor = $row['max'] + 1;
}

$nombre = $_POST["nombre"];

$ISp_Res = $con->prepare(""
        . "INSERT INTO editorial(id_editorial, nombre) "
        . "VALUES(?,?)");
$ISp_Res->execute(array($id_autor, $nombre));
?>