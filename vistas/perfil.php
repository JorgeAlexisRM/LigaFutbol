<div>
    <h1 class="titulo">PERFIL</h1>
</div>

<div class="datosUsuario">
    <img src="./img/equipo.png">

    <?php
        echo '<label>Nombre: </label>'.$_SESSION['nombre'].'<br>';
        echo '<label>Apellidos: </label>'.$_SESSION['apellido'].'<br>';
        echo '<label>ROL: </label>'.$_SESSION['rol'];
    ?>
</div>
