
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

                <div id="contenedor">

                    <form action="libro_save.php" method="post" name="formulario">
                        
                        <fieldset> </fieldset>
                        <br>
                        I.S.B.N.
                        <input name="isbn" type="text" size="80" required="" placeholder="Ingrese ISBN"/> 
                        <br>
                        <br>
                        Titulo
                        <input type="text"   name="titulo"  size="81" required="" placeholder="Ingrese un titulo">
                        <br>
                        <br>
                        Descripcion
                        <input type="text" name="subtitulo" size="75" required="" placeholder="" >
                        <br>
                        <br>
                        Año
                        <input type="number"   name="anio"  size="80" required="" >

                        Cantidad de Paginas
                        <input type="number"   name="paginas" required=""  size="80" >
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
                        <fieldset> </fieldset>
                        <br>
                        <input type="submit" value="Guardar" />
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
