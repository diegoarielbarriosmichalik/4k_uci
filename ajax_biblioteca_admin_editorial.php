<?php
include 'conexion.php';
$dbh = new PDO("pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres");
sleep(1);
?>
<select class="form-control select2" style="width: 100%;">
    <option value="0" selected="selected">Elija una editorial</option>
    <?php
    foreach ($dbh->query("select * from editorial") as $fila) {
        ?>
        <option value="<?php echo $fila['id_editorial']; ?>" ><?php echo $fila['nombre']; ?></option>
        <?php
    }
    ?>
</select>
