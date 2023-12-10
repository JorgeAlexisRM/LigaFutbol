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
        
        if(isset($_SESSION['equipo'])){
            $item .= '<a href="index.php?vista=plantilla&idEquipo='.$_SESSION['idEquipo'].'">
                <div class="item">
                    <label>Equipo: '.$_SESSION['equipo'].'</label>
                </div>
                </a>';
        }

        echo $item;
    ?>
</div>
