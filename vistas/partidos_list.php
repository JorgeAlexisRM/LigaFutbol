<!DOCTYPE html>
<html>

<head>
    <title>Lista Partidos</title>
</head>

<body class="cuerpoPartidos">
    <div>
        <h1 class="titulo">Partidos</h1>
    </div>

    <div class="listaPartidos">
        <?php
        require_once "./php/main.php";

        # Paginador categoria #
        require_once "./php/partidos_lista.php";
        ?>
    </div>
</body>

</html>