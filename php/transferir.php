<?php
// Simula la conexión y obtención de datos desde la base de datos
require_once "main.php";

if(isset($_SESSION['id'])&& $_SESSION['rol']=='entrenador'){
    $idEntrenador=$_SESSION['id'] ;
    $idEquip="";
    $conexion = conexion();
    $consultaId = $conexion->query("SELECT idEquipo FROM equipos WHERE idEntrenador='$idEntrenador'");
    if($consultaId->rowCount()===1){
        $consultaId=$consultaId->fetch();
        $idEquip= $consultaId['idEquipo'];
    }
    $idJugador = $_GET['idJugador'];

    $etiqueta="";



    $etiqueta.= '
        <form method="POST" action="./php/transfiriendoEntrenador.php" class="FormularioAjax">
            <input name="idEquipo" value="'.$_SESSION['idEquipo'].'" readonly>
            <input name="idJugador" value="'.$idJugador.'" readonly>
            <label for="cami" class="texto">Camiseta:</label>
            <input type="number" id="cami" name="camiseta">
            <button type="submit">Mostrar Equipo</button>
        </form>';

    echo $etiqueta;
    
}elseif($_SESSION['rol']=='administrador'){
    $conexion = conexion();
    $consultaEquipos = $conexion->query('SELECT nombre FROM equipos');
    $equipos = $consultaEquipos->fetchAll();
    $idJugador = $_GET['idJugador'];

    $etiqueta="";



    $etiqueta.= '
        <form method="post" action="./php/transfiriendo.php?idJugador=$idJugador&idEquipo=$equipoSeleccionado&camis=$camiseta" class="FormularioAjax">
            <!-- Input de tipo text con atributo list -->
            <label for="equipos" class="texto">Selecciona un equipo:</label>
            <input type="text" id="equipos" name="equipo" list="listaEquipos">
            <label for="cami" class="texto">Camiseta:</label>
            <input type="text" id="cami" name="camiseta" >

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
        $camiseta = (int)$_POST['camiseta'];

        echo "idJugador=$idJugador&idEquipo=$equipoSeleccionado&camiseta=$camiseta";
        header("Location: ./php/transfiriendo.php?idJugador=$idJugador&idEquipo=$equipoSeleccionado&camis=$camiseta");          
    }
}



