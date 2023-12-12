<main>
<div>
    <h1 class="titulo">PERFIL</h1>
</div>

    <div class="datosUsuario">
        <img src="./img/equipo.png">

        <?php
        $item = "";

        $item .= '<div class="item1"><label class="itemlabel">Nombre: ' . $_SESSION['nombre'] . '</label></div>
            <div class="item1"><label class="itemlabel">Apellidos: ' . $_SESSION['apellido'] . '</label></div>
            <div class="item1"><label class="itemlabel">ROL: ' . $_SESSION['rol'] . '</label></div>';

        if (isset($_SESSION['equipo']) && $_SESSION['rol'] == 'entrenador') {
            $item .= '<a href="index.php?vista=plantilla&idEquipo=' . $_SESSION['idEquipo'] . '">
                <div class="item1">
                    <label>Equipo: ' . $_SESSION['equipo'] . '</label>
                </div>
                </a>';
        } elseif ($_SESSION['rol'] == 'entrenador') {
            $item .= '<a href="index.php?vista=equipo_new">
                <div class="item">
                    <label>CREAR equipo</label>
                </div>
                </a>';

            $item .= '<a href="index.php?vista=elegir_equipo&idEntrenador='.$_SESSION['id'].'">
            <div class="item">
                <label>Seleccionar Equipo Existente</label>
            </div>
            </a>';
        }

        if ($_SESSION['rol'] == 'jugador') {
            $item .= '<div class="item1"><label class="itemlabel">Edad: ' . $_SESSION['edad'] . '</label></div>
                <div class="item1"><label class="itemlabel">Posicion: ' . $_SESSION['posicion'] . '</label></div>
                <div class="item1"><label class="itemlabel">Camiseta: ' . $_SESSION['camiseta'] . '</label></div>';

            if (isset($_SESSION['equipo'])) {
                $item .= '
                    <div class="item">
                        <label>Equipo: ' . $_SESSION['equipo'] . '</label>
                    </div>';
            }

            $item .= '<a href="index.php?vista=editar_jugador&idJugador=' . $_SESSION['id'] . '">
                <div class="item1">
                    <label class="itemlabel1">Editar</label>
                </div>
                </a>';
        }

        echo $item;
        ?>
    </div>
</main>