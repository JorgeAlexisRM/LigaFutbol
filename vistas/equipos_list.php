<div>
    <h1 class="titulo">Equipos</h1>
</div>

<div class="listaEquipos">
<?php
        require_once "./php/main.php";

        # Paginador categoria #
        require_once "./php/equipo_lista.php";
    ?>
</div>

<?php 
    if (isset($_SESSION['usuario'])&&($_SESSION['rol']=='entrenador')) {
        echo '<form class="jornada" method="POST" action="index.php?vista=tombola">
            <button type="submit">
                Generar Jornada
            </button>
            </form>
        ';
    }
?>