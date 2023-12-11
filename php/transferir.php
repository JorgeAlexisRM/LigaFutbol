<?php
// Simula la conexión y obtención de datos desde la base de datos
require_once "main.php";
$conexion = conexion();
$consultaEquipos = $conexion->query('SELECT nombre FROM equipos');
$equipos = $consultaEquipos->fetchAll();
$idJugador = $_GET['idJugador'];

$etiqueta="";



    $etiqueta.= '
    <form method="post" action="">
        <!-- Input de tipo text con atributo list -->
        <label for="equipos" class="texto">Selecciona un equipo:</label>
        <input type="text" id="equipos" name="equipo" list="listaEquipos">
        <label for="cami" class="texto">Camiseta:</label>
        <input type="text" id="cami" name="camiseta" >
        <label for="posi" class="texto">Posicion:</label>
        <input type="text" id="posi" name="posision" >

        <!-- Datalist con opciones de equipos -->
        <datalist id="listaEquipos">';
             foreach ($equipos as $equipo) {
                $etiqueta.=  '<option value='.$equipo['nombre'].'>';
             }
             $etiqueta.= '</datalist>
        <!-- Botón para mostrar el equipo seleccionado -->
        <button type="submit" name="submit">Mostrar Equipo</button>
    </form>';

    echo $etiqueta;
    // Manejar la selección del equipo cuando se envía el formulario
    if (isset($_POST['submit'])) {
        $equipoSeleccionado = $_POST['equipo'];
        $camiseta = $_POST['camiseta'];
        $posicion = $_POST['posision'];

        echo '<h1>'.$idJugador.'</h1>';
        header('Location: ./php/transfiriendo.php?idJugador='.$idJugador.'&idEquipo='.$equipoSeleccionado.'&camiseta='.$camiseta.'&posision='.$posicion.'');          
    }
    ?>


