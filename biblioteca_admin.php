
<?php

function f_remove_odd_characters($string) {
    $string = str_replace("\n", "[NEWLINE]", $string);
    $string = htmlentities($string);
    $string = preg_replace('/[^(\x20-\x7F)]*/', '', $string);
    $string = html_entity_decode($string);
    $string = str_replace("[NEWLINE]", "\n", $string);
    return $string;
}

$dbh = new PDO('pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres');

$ok = null;
session_start();
if ($_SESSION['last_access'] == "1") {
    $ok = 1;
    $menu = $_SESSION['menu'];
    $privilegio = $_SESSION['privilegio'];
}

if ($privilegio == 1) {
    $menu = 'menu_user.html';
}
if ($privilegio == 0) {
    $menu = 'menu_alumnos.html';
}

$q = null; //Initialization value; Examples
$q = isset($_GET['q']) ? $_GET['q'] : '';
$q = !empty($_GET['q']) ? $_GET['q'] : '';
if ($ok == 1) {
    ?>
    <!DOCTYPE HTML>
    <html lang="en">
        <head>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <style>
                label, input { display:block; }
                input.text { margin-bottom:12px; width:95%; padding: .4em; }
                fieldset { padding:0; border:0; margin-top:25px; }
                h1 { font-size: 1.2em; margin: .6em 0; }
                div#users-contain { width: 350px; margin: 20px 0; }
                div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
                div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
                .ui-dialog .ui-state-error { padding: .3em; }
                .validateTips { border: 1px solid transparent; padding: 0.3em; }
            </style>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


            <script>

                $(function () {
                    var dialog, form,
                            // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
                            emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
                            name = $("#name"),
                            email = $("#email"),
                            password = $("#password"),
                            allFields = $([]).add(name).add(email).add(password),
                            tips = $(".validateTips");
                    function updateTips(t) {
                        tips
                                .text(t)
                                .addClass("ui-state-highlight");
                        setTimeout(function () {
                            tips.removeClass("ui-state-highlight", 1500);
                        }, 500);
                    }

                    function checkLength(o, n, min, max) {
                        if (o.val().length > max || o.val().length < min) {
                            o.addClass("ui-state-error");
                            updateTips("Length of " + n + " must be between " +
                                    min + " and " + max + ".");
                            return false;
                        } else {
                            return true;
                        }
                    }

                    function checkRegexp(o, regexp, n) {
                        if (!(regexp.test(o.val()))) {
                            o.addClass("ui-state-error");
                            updateTips(n);
                            return false;
                        } else {
                            return true;
                        }
                    }

                    function addUser() {
                        var valid = true;
                        allFields.removeClass("ui-state-error");
                        valid = valid && checkLength(name, "username", 3, 16);
    //                        valid = valid && checkLength(email, "email", 6, 80);
    //                        valid = valid && checkLength(password, "password", 5, 16);

                        valid = valid && checkRegexp(name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");
    //                        valid = valid && checkRegexp(email, emailRegex, "eg. ui@jquery.com");
    //                        valid = valid && checkRegexp(password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");

                        if (valid) {
                            $("#users tbody").append("<tr>" +
                                    "<td>" + name.val() + "</td>" +
                                    "</tr>");
                            dialog.dialog("close");
                        }

                        return valid;
                    }

                    function Autor_guardar() {

                        var valid = true;
                        allFields.removeClass("ui-state-error");
                        valid = valid && checkLength(name, "username", 3, 16);
                        valid = valid && checkRegexp(name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");
                        if (valid) {
                            $.ajax({
                                type: "POST",
                                url: "Autor_guardar.php",
                                data: {nombre: name.val()}
                            })
                            load_autor2("0");
                            dialog.dialog("close");
                        }


                    }

                    dialog = $("#dialog-form").dialog({
                        autoOpen: false,
                        height: 400,
                        width: 350,
                        modal: true,
                        buttons: {
                            "Crear autor": Autor_guardar,
                            Cancel: function () {
                                dialog.dialog("close");
                            }
                        },
                        close: function () {
                            form[ 0 ].reset();
                            allFields.removeClass("ui-state-error");
                        }
                    });
                    form = dialog.find("form").on("submit", function (event) {
                        event.preventDefault();
                        addUser();
                    });
                    $("#create-user").button().on("click", function () {
                        dialog.dialog("open");
                    });
                });
            </script>
            <script src="ajax.js"></script>
            <title>Biblioteca</title>
            <link href = "css2/bootstrap.css" rel = "stylesheet" type = "text/css" media = "all">
            <link href="css2/style.css" rel="stylesheet" type="text/css" media="all"/>
        </head>
        <body>
            <div id="dialog-form" title="Crear nuevo autor">
                <form>
                    <fieldset>
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
                        <input type="submit"  tabindex="-1" style="position:absolute; top:-1000px">
                    </fieldset>
                </form>
            </div>

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
                    <!--<fieldset></fieldset>-->
                </div>
            </div>
            <?php
            if ($q == 'add_book') {
                ?>
                <div class="container">
                    <form enctype="multipart/form-data" action="" method="POST">
                        <div class="box box-success">
                            <br>
                            <h3 class="box-title">Información del libro</h3>
                            <!--                                        <div class="box-header with-border">
                                                                    </div>-->
                            <div class="box-body">
                                <input class="form-control input-lg" type="text" placeholder="Título">
                                <br>
                                <input class="form-control" type="text" placeholder="Descripción">
                                <br>

                                <div id="myDiv2" style="float: left; width: 550px;" >
                                    <select class="form-control select2" style="width: 100%;">
                                        <option value="0" selected="selected">Elija un Autor</option>
                                        <?php
                                        foreach ($dbh->query("SELECT * from autor") as $fila) {
                                            ?>
                                            <option value="<?php echo $fila['id_autor']; ?>" ><?php echo $fila['nombre']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div style="float: left; width: 560px;" >
                                    <a id="create-user" >Agregar Autor</a>
                                </div> 

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <br>
                                <div class="box-header with-border" style="width: 100%;" >
                                    <select class="form-control select2" style="width: 100%;" onchange="load(this.value)">
                                        <option value="0" selected="selected">Sistema Dewey de clasificación (1er nivel)</option>
                                        <?php
                                        foreach ($dbh->query("SELECT * from clasificacion where clasificacion > 0 order by id_clasificacion") as $fila) {
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
                                </div>
                                <br>
                                <div  id="myDiv"  style="width: 100%;" >

                                </div>
                                <br>


                                <div class = "form-group">
                                    <label for = "exampleInputFile">Agregar portada</label>
                                    <input type = "file" id = "exampleInputFile" >
                                </div>
                                <br>

                                <button type = "button" class = "btn btn-block btn-primary">Guardar Libro</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
            } else {
                ?>
                <div class="gallery" id="gallery">
                    <div class="container">
                        <div class="gallery-main">
                            <div class="gallery-bott">
                                <?php
//                                $contenido = null;
//                                $contenido = isset($_POST['buscar']) ? $_POST['buscar'] : '';
//                                $contenido = !empty($_POST['buscar']) ? $_POST['buscar'] : '';
//                                if ($contenido != null) {
//                                    $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=biblioteca;user=postgres;password=postgres');
//                                    foreach ($dbh->query(""
//                                            . "SELECT * from libro "
//                                            . "inner join editorial on editorial.id_editorial = libro.id_editorial "
//                                            . "where titulo ilike '%$contenido%' ") as $fila) {
//                                        $id = $fila['id_libro'];
//                                        $exif = exif_read_data("images/" . $id . ".jpg", 'IFD0');
//                                        $exif = exif_read_data("images/" . $id . ".jpg", 0, true);
//                                        foreach ($exif as $clave => $sección) {
//                                            foreach ($sección as $nombre => $var) {
//                                                if (is_string($var)) {
//                                                    $nuevo = f_remove_odd_characters($var);
//                                                    $resultado = strpos($nuevo, $contenido);
//                                                    if ($resultado !== FALSE) {
//                                                        
                                ?>
                                <!--                                <div class="col-md-4 col1 gallery-grid">
                                                                    <figure class="effect-bubba">
                                                                        <img class="img-responsive" src="images///?php echo $fila['id_libro']; ?>.jpg" alt="">
                                                                        <figcaption>
                                                                            <h4 class="gal">//?php echo $fila['titulo']; ?></h4>
                                                                            <p class="gal1">ISBN: //?php echo $fila['isbn']; ?></p>	
                                                                            <p class="gal1">Editorial: //?php echo $fila['nombre']; ?></p>	
                                                                            <p class="gal1">//?php echo $fila['num_pag']; ?>  Pag. </p>	
                                                                        </figcaption>			
                                                                    </figure>
                                                                </div>-->
                                <?php
//                                                    }
//                                                    $nuevo = "";
//                                                }
//                                            }
//                                        }
//                                    }
//                                }
//                                
                                ?>
                                <?php
                                $contenido = null; //Initialization value; Examples
                                $contenido = isset($_POST['buscar']) ? $_POST['buscar'] : '';
                                $contenido = !empty($_POST['buscar']) ? $_POST['buscar'] : '';
                                if ($contenido != null) {
                                    foreach ($dbh->query("SELECT * from libro inner join editorial on editorial.id_editorial = libro.id_editorial where titulo ilike '%$contenido%' ") as $fila) {
                                        if ($fila['id_libro'] > 0) {
                                            ?>
                                            <div class="col-md-4 col1 gallery-grid">
                                                <!--<a href="images/g1.jpg" rel="title" class="b-link-stripe b-animate-go  thickbox">-->
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