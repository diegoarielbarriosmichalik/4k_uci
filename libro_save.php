<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_libro) FROM libro';
foreach ($con->query($sql) as $row) {
    $id_libro = $row['max'] + 1;
}

$isbn = $_POST["isbn"];
$titulo = $_POST["titulo"];
$subtitulo = $_POST["subtitulo"];
$imagen = ' ';
$anio = $_POST["anio"];
$num_pag = $_POST["num_pag"];
$id_categoria = $_POST["id_categoria"];
$id_autor = $_POST["id_autor"];
$id_editorial = $_POST["id_editorial"];

$ISp_Res = $con->prepare("INSERT INTO libro(id_libro, isbn, titulo, subtitulo,imagen, anio,num_pag,id_categoria, id_autor, id_editorial) VALUES(?,?,?,?,?,?,?,?,?,?)");
$ISp_Res->execute(array($id_libro, $isbn, $titulo,$subtitulo,$imagen,$anio,$num_pag,$id_categoria,$id_autor,$id_editorial));

header('Location: libro_list.php');
?>


