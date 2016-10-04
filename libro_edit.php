<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM libro where id_libro = '$id'";

    include ("./conexion.php");
    $con = conectar();
    foreach ($con->query($sql) as $row) {
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
                <h3>Ingrese la informacion</h3>
                <div id="contenedor">
                    <fieldset>
                        <form action="libro_update.php" method="post" name="formulario">
                            <br>
                            ISBN  
                            <input name="isbn" type="text" size="80" required="" value="<?= $isbn ?>"/> 
                            <br>
                            <br>
                            Titulo
                            <input type="text"   name="titulo"  size="79" required="" value="<?= $titulo ?>">
                            <br>
                            <br>
                            Subtitulo
                            <input type="text" size="76"  name="subtitulo"  required="" value="<?= $subtitulo ?>">
                            <br>
                            <br>
                            Año
                            <input type="number"   name="anio"  size="80" required="" placeholder="Ingrese el año">

                            Nro de Paginas
                            <input type="number"   name="paginas" required=""  size="80" placeholder="Nro de Paginas">
                            
                            <!--<a href="libro_indice.php?id=<?$isbn?>" >Ver indice</a>-->
                            
                            <br>
                            <br>

                            Categoria
                            <select name="id_categoria" required="">
                                <option value="1" >Categoria 1</option>
                            </select>
                          
                            
                            Autor
                            <select name="id_autor" required="">
                                <option value="" >Elija un autor</option>
                                <option value="1" >Autor 1</option>
                            </select>
                           
                            
                            Editorial
                            <select name="id_editorial" required="">
                                <option value="" >Elija una editorial</option>
                                <option value="1" >Editorial 1</option>
                            </select>
                            <br>
                            <br>

                            <input type="submit" value="Actualizar los datos" />

                            &nbsp; &nbsp; &nbsp; &nbsp;                 

                            
                            
                            <br>
                            <br>

                        </form>
                    </fieldset>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>
