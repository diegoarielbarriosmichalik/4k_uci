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
                <img src="images/banner.png" width="1200" height="359" alt=""></img>
            </div>
        </div>
    </body>
</html>