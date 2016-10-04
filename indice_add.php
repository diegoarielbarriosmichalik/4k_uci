<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_indice) FROM indice';
foreach ($con->query($sql) as $row) {
    $id = $row['max'] + 1;
}

$indice = $_POST["indice"];

if (isset($_POST["sub_indice_1"])) {
    $sub_indice_1 = $_POST["sub_indice_1"];
    if ($_POST["sub_indice_1"] == NULL) {
        $sub_indice_1 = '0';
        echo "Indice 1 $sub_indice_1 ";
    } else {
        echo "Indice 1 $sub_indice_1 ";
    }
}

if (isset($_POST["sub_indice_2"])) {
    $sub_indice_2 = $_POST["sub_indice_2"];
    if ($_POST["sub_indice_2"] == NULL) {
        $sub_indice_2 = '0';
        echo "Indice 2 $sub_indice_2 ";
    } else {
        echo "Indice 2 $sub_indice_1 ";
    }
}

$contenido = $_POST["contenido"];
$pagina = $_POST["pagina"];
$id_libro = $_POST["id_libro"];

$ISp_Res = $con->prepare("INSERT INTO indice(id_indice, nro, contenido, pagina, id_libro, sub_indice_1, sub_indice_2) VALUES(?,?,?,?,?,?,?)");
$ISp_Res->execute(array($id, $indice, $contenido, $pagina, $id_libro, $sub_indice_1, $sub_indice_2));

header("Location: libro_indice.php?id=$id_libro");
?>


