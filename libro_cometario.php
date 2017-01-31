<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_comentario) FROM comentario';
foreach ($con->query($sql) as $row) {
    $id_comentario = $row['max'] + 1;
}

$id_libro = $_POST["id_libro"];
$comentario = $_POST["comentario"];
$contenido = $_POST["contenido"];
 

$ISp_Res = $con->prepare(""
        . "INSERT INTO comentario(id_comentario, comentario, id_libro,  id_inscriptions) "
        . "VALUES(?,?,?,?)");
$ISp_Res->execute(array($id_comentario, $comentario, $id_libro, 1));


header("Location: biblioteca_admin.php?contenido=".$contenido);
?>


