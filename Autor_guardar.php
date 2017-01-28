<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_autor) FROM autor';
foreach ($con->query($sql) as $row) {
    $id_autor = $row['max'] + 1;
}

$nombre = $_POST["nombre"];

$ISp_Res = $con->prepare(""
        . "INSERT INTO autor(id_autor, nombre) "
        . "VALUES(?,?)");
$ISp_Res->execute(array($id_autor, $nombre));
?>