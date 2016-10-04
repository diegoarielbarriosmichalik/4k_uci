
<?php
session_start();
$_SESSION['last_access'] = "0";
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>UCI</title>
        <link href="css2/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <script src="js/jquery-1.11.0.min.js"></script>
        <link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Training Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href='//fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Kreon:400,700,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/move-top.js"></script>
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
        <script src="js/bootstrap.min.js"></script>


    </head>
    <body onload="">
        <!--header start here-->
        <div class="banner">
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
                            <?php // include './menu.html'; ?>        
                        </ul>
                    </div>
                </div>



                <div class="banner-bottom">


                    <link rel="stylesheet" href="css3/style_login.css">
                    <div class="vid-container">
                        <div class="inner-container">
                            <div class="box">
                                <h1>Iniciar Sesión</h1>



                                <form name="fvalida" method="post" action="validar_ingreso.php">
                                    <input type="text" autofocus="" name="codigo" placeholder="Código"/>
                                    <input type="password" name="clave"  placeholder="Clave"/>
                                    <input value="Ingresar" type="submit" id="inciar"></td>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </body>
</html>