<?php

include ("./conexion.php");
$con = conectar();
$sql = 'SELECT max(id_libro) FROM libro';
foreach ($con->query($sql) as $row) {
    $id_libro = $row['max'] + 1;
}

$isbn = $_POST["isbn"];
$titulo = $_POST["titulo"];
$subtitulo = $_POST["descripcion"];
$imagen = ' ';
$id_clasificacion = $_POST["id_clasificacion"];
$id_autor = $_POST["id_autor"];

$ISp_Res = $con->prepare(""
        . "INSERT INTO libro(id_libro, isbn,   titulo,  subtitulo,  imagen, anio,  num_pag, id_autor, id_editorial, img, id_clasificacion) "
        . "VALUES(?,?,?,?,?,?,?,?,?,?,?)");
$ISp_Res->execute(array($id_libro, $isbn, $titulo, $subtitulo, $imagen, 1, 0, $id_autor, 1, 0, $id_clasificacion));


//$dir_subida = 'C:/Sistema/imagenes/';
//$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
//
//
//if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
//    echo "El fichero es válido y se subió con éxito.\n";
//} else {
//    echo "¡Posible ataque de subida de ficheros!\n";
//}
//
////echo 'Más información de depuración:';
//print_r($_FILES);
//print "</pre>";
// otro
//
//$target_dir = "C:/Sistema/imagenes/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = 1;
//    } else {
//        echo "File is not an image.";
//        $uploadOk = 0;
//    }
//}

if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    // $expensions= array("jpeg","jpg","png","jpg");
//      if(in_array($file_ext,$expensions)=== false){
//         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
//      }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $id_libro . "." . $file_ext);
        echo "Success";
    } else {
        print_r($errors);
    }
}

header('Location: biblioteca_admin.php');
?>


