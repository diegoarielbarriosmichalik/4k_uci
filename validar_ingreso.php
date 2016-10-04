<?php

try {
    include ("./conexion.php");
    $dbh = conectar();
    session_start();

    $codigo = $_POST["codigo"];
    $clave = $_POST["clave"];
    $si = '0';
    $sql = "SELECT * from accounts "
            . "inner join inscriptions on inscriptions.id = accounts.inscription_id "
            . "where accounts.is_enabled is TRUE "
            . "and inscriptions.cod_inscripcion = '$codigo' "
            . "and inscriptions.clave = '$clave' ";
    foreach ($dbh->query($sql) as $fila) {
        $location = 'Location: biblioteca.php';
        header($location);
        $si = '1';
        $_SESSION['last_access'] = "1";
        $_SESSION['menu'] = 'menu_alumnos.html';
    }
    
    $sql = "SELECT * from users "
            . "where username = '$codigo' "
            . "and encrypted_password = '$clave' ";
    foreach ($dbh->query($sql) as $fila) {
        $location = 'Location: biblioteca_admin.php';
        header($location);
        $si = '1';
        $_SESSION['last_access'] = "1";
        $_SESSION['menu'] = 'menu_user.html';
    }

    if ($si == '0') {
        $_SESSION['last_access'] = "0";
        $location = 'Location: Logueo.php';
        header($location);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    // habilitar pdo_psql en php.ini
}
?>