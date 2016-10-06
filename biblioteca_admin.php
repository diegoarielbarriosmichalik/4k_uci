
<?php

function f_remove_odd_characters($string) {
    $string = str_replace("\n", "[NEWLINE]", $string);
    $string = htmlentities($string);
    $string = preg_replace('/[^(\x20-\x7F)]*/', '', $string);
    $string = html_entity_decode($string);
    $string = str_replace("[NEWLINE]", "\n", $string);
    return $string;
}

$ok = null;
session_start();
if ($_SESSION['last_access'] == "1") {
    $ok = 1;
    $menu = $_SESSION['menu'];
}
$q = null; //Initialization value; Examples
$q = isset($_GET['q']) ? $_GET['q'] : '';
$q = !empty($_GET['q']) ? $_GET['q'] : '';
if ($ok == 1) {
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Biblioteca</title>
            <link href = "css2/bootstrap.css" rel = "stylesheet" type = "text/css" media = "all">
            <script src="js/jquery-1.11.0.min.js"></script>
            <link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="" />
            <script type="application/x-javascript"> 
                addEventListener("load", 
                function() { setTimeout(hideURLbar, 0); }, 
                false); 
                function hideURLbar(){ 
                window.scrollTo(0,1); 
                } 
            </script>
            <link href='//fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
            <link href = '//fonts.googleapis.com/css?family=Kreon:400,700,300' rel = 'stylesheet' type = 'text/css'>
            <script type = "text/javascript" src = "js/move-top.js"></script>
            <script type="text/javascript" src="js/easing.js"></script>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
            </script>
            <!-- //end-smoth-scrolling -->
            <!--light-box-files -->
            <script src="js/jquery.chocolat.js"></script>
            <link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen" charset="utf-8">
            <!--light-box-files -->
            <script type="text/javascript" charset="utf-8">
    $(function () {
        $('.gallery-grid a').Chocolat();
    });
            </script>

            <script src="js/bootstrap.min.js"></script>


        </head>
        <body>
            <!--header start here-->
            <div class="banner2">
                <div class="container">
                    <div class="header">
    <?php include './header.html'; ?>        
                    </div>
                    <div class="top-nav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <?php
                                include "./$menu";
                                ?>	        
                            </ul>
                        </div>
                    </div>
                    <br>
                    <form action="biblioteca_admin.php" method="post">
                        <div class="input-group input-group-sm">
                            <input type="text" name="buscar" autofocus placeholder="Buscar libro..." class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat">Buscar!</button>
                            </span>
                        </div>
                    </form>
                    <br>
                    <fieldset></fieldset>
                </div>
            </div>
            <?php
            if ($q == 'add_book') {
                ?>
                <div class="gallery" id="gallery">
                    <div class="container">
                        <div class="gallery-main">
                            <div class="gallery-bott">
                                <form enctype="multipart/form-data" action="libro_save.php" method="POST">
                                    <strong> I.S.B.N.&nbsp; </strong> <input name="isbn" type="text" size="80" required="" placeholder="Ingrese ISBN"/> 
                                    <br><br>
                                    <strong> Título &nbsp; </strong>
                                    <input type="text"   name="titulo"  size="80" required="" placeholder="Ingrese un titulo">
                                    <br><br>
                                    <strong> Descripción </strong>
                                    <input type="text" name="subtitulo" size="76" required="" placeholder="" >
                                    <br><br>
                                    <strong> Autor </strong>
                                    <select name="id_autor" required="">
                                        <option value="" >Elija un autor</option>
                                        <option value="1" >Autor 1</option>
                                    </select>
                                    <br><br>
                                    <strong> Nro. de Páginas </strong>
                                    <input type="number"   name="paginas" required=""  >
                                    <br><br>
                                    <input type="file" name="image"  required="" />
                                    <br><br>
                                    <input type="submit" value="Guardar" />
                                    <br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="gallery" id="gallery">
                    <div class="container">
                        <div class="gallery-main">
                            <div class="gallery-bott">
                                <?php
                                $contenido = null;
                                $contenido = isset($_POST['buscar']) ? $_POST['buscar'] : '';
                                $contenido = !empty($_POST['buscar']) ? $_POST['buscar'] : '';
                                if ($contenido != null) {
                                    $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres');
                                    foreach ($dbh->query(""
                                            . "SELECT * from libro "
                                            . "inner join editorial on editorial.id_editorial = libro.id_editorial "
                                            . "where titulo ilike '%$contenido%' ") as $fila) {
                                        $id = $fila['id_libro'];
                                        $exif = exif_read_data("images/" . $id . ".jpg", 'IFD0');
                                        $exif = exif_read_data("images/" . $id . ".jpg", 0, true);
                                        foreach ($exif as $clave => $sección) {
                                            foreach ($sección as $nombre => $var) {
                                                if (is_string($var)) {
                                                    $nuevo = f_remove_odd_characters($var);
                                                    $resultado = strpos($nuevo, $contenido);
                                                    if ($resultado !== FALSE) {
                                                        ?>
                                                        <div class="col-md-4 col1 gallery-grid">
                                                            <figure class="effect-bubba">
                                                                <img class="img-responsive" src="images/<?php echo $fila['id_libro']; ?>.jpg" alt="">
                                                                <figcaption>
                                                                    <h4 class="gal"><?php echo $fila['titulo']; ?></h4>
                                                                    <p class="gal1">ISBN: <?php echo $fila['isbn']; ?></p>	
                                                                    <p class="gal1">Editorial: <?php echo $fila['nombre']; ?></p>	
                                                                    <p class="gal1"><?php echo $fila['num_pag']; ?>  Pag. </p>	
                                                                </figcaption>			
                                                            </figure>
                                                        </div>
                                                        <?php
                                                    }
                                                    $nuevo = "";
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php } ?>
        </body>
    </html>
    <?php
} else {
    header('Location: login.php');
}
?>