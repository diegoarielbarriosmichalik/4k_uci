<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM libro where id_libro = '$id'";

    include ("./conexion.php");
    $con = conectar();
    foreach ($con->query($sql) as $row) {
        $id_libro = $row[0];
        $isbn = $row[1];
        $titulo = $row[2];
        $subtitulo = $row[3];
    }
}
?>

<html>
    <head>
        <?php include './head_admin_panel.php'; ?>
    </head>
    <body>
        <div class="banner">
            <br>
            <br>
            <div class="col-md-7 logo">
                <a href="index.html"><h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Biblioteca UCI</h1></a>
            </div>
            <div  class = "container">
                <br>
                <?php
                include './menu_admin_panel.html';
                ?>
                <br>
                <br>
                <br>
                <h3>&nbsp; <?= $titulo ?> - Indice</h3>
                <div id="contenedor">
                    <fieldset>
                        <br>
                        ISBN  
                        <input name="isbn" disabled="" type="text" size="50" required="" value="<?= $isbn ?>"/> 
                        <input name="id_libro" hidden="" type="text" size="50" required="" value="<?= $id_libro ?>"/> 
                        <input name="isbn" disabled="" type="text" size="50" required="" value="<?= $titulo ?>"/> 
                        <br>
                        <br>
                    </fieldset>
                    <br>
                </div>

                <div class="datagrid">
                    <table>
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Contenido</th>
                                <th>Pagina</th>
                        </thead>

                        <form action="indice_add.php" method="post" name="formulario">
                            <input name="id_libro" hidden="" type="text" size="50" required="" value="<?= $id_libro ?>"/> 
                            <td>
                                <input type="text"   name="pagina"  size="8" required="" placeholder="Ingrese pagina...">
                            </td>
                            <td>
                                <input type="text"   name="contenido"  size="70 required="" placeholder="Ingrese contenido...">
                            </td>

                            <input hidden="" type="submit" value="Agregar" />
                        </form>

                        <?php
                        foreach ($con->query("SELECT * FROM indice where id_libro = '$id_libro' ") as $row) {
                            echo "<tr></tr>";


                            $indice_mostrar = $row[1];

                            if ($row[5] > 0) {

                                $indice_mostrar = $row[1] . "." . $row[5];
                            }

                            if ($row[6] > 0) {

                                $indice_mostrar = $row[1] . "." . $row[5] . "." . $row[6];
                            }


                            echo "<td> $indice_mostrar </td>";

                            echo "<td> $row[2]</td>";
                            echo "<td> $row[3]</td>";
                            echo "<tr></tr> ";
                        }
                        ?>

                    </table>
                </div>
                <br>
                <br>
            </div>
        </div>
    </body>
</html>
