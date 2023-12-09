<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            include "./inc/head.php";

            if(isset($_GET['vista']) && is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="home" && $_GET['vista']!=""){

                include "./inc/".$_GET['vista'].".php";
            }
        ?>
    </head>
    <body>
        <?php

            include "./inc/navbar.php";

            if(!isset($_GET['vista']) || $_GET['vista']==""){
                $_GET['vista']="home";
            }


            if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="home" && $_GET['vista']!="404"){

                /*== Cerrar sesion ==*/
                /*if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
                    //include "./vistas/logout.php";
                    echo "No pudo cargar la pagina";
                    exit();
                }*/

                include "./vistas/".$_GET['vista'].".php";

            }else{
                if($_GET['vista']=="home"){
                    include "./vistas/home.php";
                }else{
                    include "./vistas/404.php";
                }
            }

            include "./inc/footer.php";
            include "./inc/script.php";
        ?>
        
    </body>

</html>