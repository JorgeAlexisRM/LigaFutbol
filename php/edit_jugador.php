<?php

    $idJugador = $_GET['idJugador'];

    $consulta_datos = "SELECT * FROM jugadores WHERE idJugador='$idJugador'";

    $conexion = conexion();

    $jugador = $conexion->query($consulta_datos);
    if($jugador->rowCount()===1){
    	$jugador=$jugador->fetch();

        echo '<form action="./php/actualizar_jugador.php" class="FormularioAjax" method="POST" autocomplete="off" enctype="multipart/form-data" >
        <div class="idJugador">
        <label>Id Usuario: </label>
            <input name="idJugador" type="text" value="'.$jugador['idJugador'].'" readonly>
        </div>
        <div class="nombre">
            <label>Nombre: </label>
            <input name="nombre" type="text" value="'.$jugador['nombre'].'" readonly>
        </div>
        <div class="apellido">
            <label>Apellido: </label>
            <input name="apellido" type="text" value="'.$jugador['apellido'].'" readonly>
        </div>
        <div class="edad">
        <label>Edad: </label>
            <input name="edad" type="number">
        </div>
        <div class="posicion">
        <label>Posicion: </label>
            <input name="posicion" type="text">
        </div>
            <button class="btnMulti" type="submit">Actualizar Datos</button>
        </form>
        ';
    }
    ?>