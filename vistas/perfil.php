<div>
    <h1 class="titulo">PERFIL</h1>
</div>

<div class="datosUsuario">
    <img src="./img/equipo.png">

    <?php
        $item="";

        $item .= '<div class="item"><label>Nombre: '.$_SESSION['nombre'].'</label></div>
            <div class="item"><label>Apellidos: '.$_SESSION['apellido'].'</label></div>
            <div class="item"><label>ROL: '.$_SESSION['rol'].'</label></div>';
        
        if(isset($_SESSION['equipo'])&&$_SESSION['rol']=='entrenador'){
            $item .= '<a href="index.php?vista=plantilla&idEquipo='.$_SESSION['idEquipo'].'">
                <div class="item">
                    <label>Equipo: '.$_SESSION['equipo'].'</label>
                </div>
                </a>';
        }

        if($_SESSION['rol']=='jugador'){
            $item .= '<div class="item"><label>Edad: '.$_SESSION['edad'].'</label></div>
                <div class="item"><label>Posicion: '.$_SESSION['posicion'].'</label></div>
                <div class="item"><label>Camiseta: '.$_SESSION['camiseta'].'</label></div>';

            if(isset($_SESSION['equipo'])){
                $item .= '
                    <div class="item">
                        <label>Equipo: '.$_SESSION['equipo'].'</label>
                    </div>';
            }

            $item.='<a href="index.php?vista=editar_jugador&idJugador='.$_SESSION['id'].'">
                <div class="item">
                    <label>Editar</label>
                </div>
                </a>';
        }

        echo $item;
    ?>
</div>