


<html>
    <head>
        <?php include './head_admin_panel.php'; ?>
    </head>
    <body >
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
                <h4><a href="libro_new.php" > Agregar Libro </a></h4>
                <br>
                <form action="libro_list.php" method="POST">
                    Buscar:
                    <select name="criterio" required="" >
                        <option value="1">ISBN</option>
                        <option value="2">TITULO</option>
                        <option value="3">CONTENIDO</option>
                    </select>
                    <input name="buscar" size="70" placeholder="buscar..." required="">
                </form>
                <br>

                <?php
                if (isset($_POST["buscar"])) {

                    $buscar = $_POST["buscar"];

                    if (($_POST["criterio"]) == '1') {
                        $criterio = "ISBN";
                    }
                    if (($_POST["criterio"]) == '2') {
                        $criterio = "TITULO";
                    }
                    if (($_POST["criterio"]) == '3') {
                        $criterio = "CONTENIDO";
                    }

                    echo "Criterio de busqueda: $criterio; Buscado como: $buscar";

                    echo '<br><br>';
                }
                ?>


                <div class="datagrid">
                    <table>
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Titulo</th>
                                <!--<th>Subtitulo</th>-->
                                <th>Contenido</th>
                                <th>Opciones</th>
                        </thead>


                        <?php
                        include ("./conexion.php");
                        $con = conectar();

                        if (isset($_POST["buscar"])) {
                            $buscar = $_POST["buscar"];


                            if (($_POST["criterio"]) == '1') {
                                $sql = "SELECT * FROM libro where isbn ilike '$buscar'";
                                foreach ($con->query($sql) as $row) {
                                    echo "<tr></tr>";
                                    echo "<td> $row[1]</td>";
                                    echo "<td> $row[2]</td>";
//                                    echo "<td> $row[3]</td>";
                                    echo "<td> --- </td>";
                                    echo "<td> <a href='libro_edit.php?id=$row[0]'> Editar ";
                                    echo "    -   ";
                                    echo " <a href='libro_indice.php?id=$row[0]'> Ver indice</td>";
                                }
                            }
                            if (($_POST["criterio"]) == '2') {
                                $sql = "SELECT * FROM libro where titulo ilike '%$buscar%'";
                                foreach ($con->query($sql) as $row) {
                                    echo "<tr></tr>";
                                    echo "<td> $row[1]</td>";
                                    echo "<td> $row[2]</td>";
//                                    echo "<td> $row[3]</td>";
                                    echo "<td> --- </td>";
                                    echo "<td> <a href='libro_edit.php?id=$row[0]'> Editar ";
                                    echo "    -   ";
                                    echo " <a href='libro_indice.php?id=$row[0]'> Ver indice</td>";
                                }
                            }
                            if (($_POST["criterio"]) == '3') {
                                $sql = "SELECT * FROM libro 
                                        inner join indice on
                                        libro.id_libro = indice.id_libro
                                        where contenido ilike '%$buscar%'";

                                foreach ($con->query($sql) as $row) {
                                    echo "<tr></tr>";
                                    echo "<td> $row[1]</td>";
                                    echo "<td> $row[2]</td>";
//                                    echo "<td> $row[3]</td>";
                                    echo "<td> $row[12] - Pag. $row[13] </td>";
                                    echo "<td> <a href='libro_edit.php?id=$row[0]'> Editar ";
                                    echo "    -   ";
                                    echo " <a href='libro_indice.php?id=$row[0]'> Ver indice</td>";
                                }
                            }
                        }
                        ?>

                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>