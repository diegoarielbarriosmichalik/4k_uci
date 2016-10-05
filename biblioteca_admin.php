
<?php
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
            <!--jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="js/jquery-1.11.0.min.js"></script>
            <!-- Custom Theme files -->
            <link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
            <!-- Custom Theme files -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="Training Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
                  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
            <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
            <!--Google Fonts-->
            <link href='//fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
            <link href = '//fonts.googleapis.com/css?family=Kreon:400,700,300' rel = 'stylesheet' type = 'text/css'>
            <!--start-smoth-scrolling -->
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
                                    <!--<form action="" method="post" name="formulario">-->


                                    <strong> I.S.B.N.&nbsp; </strong> <input name="isbn" type="text" size="80" required="" placeholder="Ingrese ISBN"/> 
                                    <br>
                                    <br>
                                    <strong> Título &nbsp; </strong>
                                    <input type="text"   name="titulo"  size="80" required="" placeholder="Ingrese un titulo">
                                    <br>
                                    <br>
                                    <strong> Descripción </strong>
                                    <input type="text" name="subtitulo" size="76" required="" placeholder="" >
                                    <br>
                                    <br>


                                    <strong> Autor </strong>
                                    <select name="id_autor" required="">
                                        <option value="" >Elija un autor</option>
                                        <option value="1" >Autor 1</option>
                                    </select>
                                    <br>
                                    <br>
                                    <strong> Nro. de Páginas </strong>
                                    <input type="number"   name="paginas" required=""  >
                                    <br>
                                    <br>


                                <!--                                        <strong> Carátula </strong>
                                     <input type="text" size="63"  name="imagen" required=""   > 

                                     <input type="submit" value="Buscar imagen" />-->


                                    <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
        <!--                                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                                     El nombre del elemento de entrada determina el nombre en el array $_FILES 
                                    Carátula: <input name="fichero_usuario" type="file" />
                                    <input type="submit" value="Enviar fichero" />-->


                <!--                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                                    <input type="submit" value="Upload Image" name="submit">-->

                                    <input type="file" name="image" />
                                    <input type="submit"/>
                                    <br>
                                    <br>
                                    <input type="submit" value="Guardar" />
                                    <br>
                                    <br>
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
                                $contenido = null; //Initialization value; Examples
                                $contenido = isset($_POST['buscar']) ? $_POST['buscar'] : '';
                                $contenido = !empty($_POST['buscar']) ? $_POST['buscar'] : '';
                                if ($contenido != null) {

                                    $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres');
                                    foreach ($dbh->query("SELECT * from libro inner join editorial on editorial.id_editorial = libro.id_editorial where titulo ilike '%$contenido%' ") as $fila) {
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