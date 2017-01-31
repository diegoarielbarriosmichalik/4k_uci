<?php
include 'conexion.php';

$q = $_POST['q'];

$dbh = new PDO("pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres");
?>

<select name="id_clasificacion_nv_2" class="form-control select2" style="width: 100%;">
    <option  value="0" selected="selected">Sistema Dewey de clasificación (2do nivel)</option>
    <?php
   foreach ($dbh->query("select * from clasificacion_nivel_2 where id_clasificacion = '" . $q . "'") as $fila) {
        ?>
         <option value="<?php echo $fila['id_clasificacion']; ?>" ><?php
            echo $fila['clasificacion'];
            echo " - ";
            echo $fila['descripcion']
            ?></option>
        <?php
    }
    ?>
</select>
