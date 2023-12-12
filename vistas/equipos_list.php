<main>
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
    require_once "./php/main.php";

    if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == 'administrador')) {
        $consulta_datos = "SELECT * FROM torneos";

        $conexion = conexion();

        $datos = $conexion->query($consulta_datos);
        $datos = $datos->fetchAll();
        $contador = 0;

        foreach ($datos as $dato) {
            if ($dato['enjuego'] == 0) {
                $contador += 1;
            }
        }

        if ($contador == 0) {
            echo '<form class="jornada" method="POST" action="index.php?vista=tombola">
                <button type="submit">
                    Generar Jornada
                </button>
                </form>
            ';
        }
    }
    ?>
</main>