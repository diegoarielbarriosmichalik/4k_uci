


<!DOCTYPE HTML>
<html>
    <head>


        <?php include './head_admin_panel.php'; ?>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
        <!-- //end-smoth-scrolling -->

    </head>
    <body>
        <!--header start here-->
        <div class="banner">
            <br>
            <br>
            <div class="col-md-7 logo">
                <h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Biblioteca UCI</h1>
            </div>
            <div  class = "container">

                <br>
                <?php include './menu_admin_panel.html'; ?>


               
                    <br>
                    <br>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">

                        <thead>
                            <tr>

                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>


                            </tr>
                        </thead>

                        <tbody>
                            <?php $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres');
                            foreach ($dbh->query('SELECT * from libro') as $fila) {
                                ?>
                                <tr>
                                    <td><?php echo $fila['id_libro']; ?></td>
                                    <td> <?php echo $fila['isbn']; ?></td>
                                    <td>
                                       <!--<input type="button" title="Borrar Alumno" href="javascript:;" onclick="aviso('alumno_borrar.php?id=<?php echo $fila['id_libro'] ?>'); return false;" name="Agregar indice" value="Agregar indice">-->
                                        <input type="button" 
                                               title="Editar Alumno" 
                                               href="javascript:;" 
                                               onclick="aviso('alumno_editar.php?id=<?php echo $fila['id_libro'] ?>'); 
                                                   return false;" 
                                                   name="Editar" 
                                                   value="Modificar">
                                        <!--<input type="button" title="Ver Materias" href="javascript:;" onclick="aviso('calificaciones_list_dt.php?id=<?php echo $fila['id_libro'] ?>'); return false;" name="Ver Materias" value="Ver Materias">-->
                                        <!--<input type="button" title="Historial" href="javascript:;" onclick="aviso('historial_curso.php?id=<?php echo $fila['id_libro'] ?>'); return false;" name="Historial" value="Historial">-->
                                    </td>
                                </tr>

<?php } ?>

                        </tbody>

                    </table>
                    <br>
                    <br>
            


            </div>
        </div>
    </body>
</html>

