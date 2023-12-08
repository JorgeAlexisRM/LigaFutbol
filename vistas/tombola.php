<div>
    <h1 class="titulo">Liga</h1>
</div>

<div class="respuesta">

</div>


<div class="listaPartidos">
<?php
        require_once "./php/main.php";

        # Paginador categoria #
        require_once "./php/tombola.php";
    ?>
</div>

<form class="jornada" method="POST" action="./php/guardarJornada.php"  enctype="multipart/respuesta">
    <button type="submit">
        Guardar Jornada
    </button>
</form>

