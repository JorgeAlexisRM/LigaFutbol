<?php

$conexion = conexion();
$consultaEquipos = $conexion->query('SELECT nombre FROM equipos');
$equipos = $consultaEquipos->fetchAll();
$idEntrenador = $_GET['idEntrenador'];

$etiqueta="";

    $etiqueta.= '
    <form method="POST" action="./php/asignarEntrenador.php" class="FormularioAjax">
        <!-- Input de tipo text con atributo list -->
        <input name="idEntrenador" value="'.$idEntrenador.'" readonly>
        <label for="equipos" class="texto">Selecciona un equipo:</label>
        <input type="text" id="equipos" name="equipo" list="listaEquipos">

        <!-- Datalist con opciones de equipos -->
        <datalist id="listaEquipos">';

    foreach ($equipos as $equipo) {
    $etiqueta.=  '<option value='.$equipo['nombre'].'>';
    }
             $etiqueta.= '</datalist>
        <!-- Botón para mostrar el equipo seleccionado -->
        <button type="submit" name="submit">Asignar Equipo</button>
    </form>';

    echo $etiqueta;

    $conexion=null;
    ?>