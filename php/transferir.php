<?php
// Simula la conexión y obtención de datos desde la base de datos
require_once "main.php";
if(isset($_SESSION['id'])&&$_SESSION['rol']=='entrenador'){
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
        <form method="post" action="">
            <label for="cami" class="texto">Camiseta:</label>
            <input type="text" id="cami" name="camiseta">
            <button type="submit" name="submit">Mostrar Equipo</button>
        </form>';

    echo $etiqueta;
    // Manejar la selección del equipo cuando se envía el formulario
    if (isset($_POST['submit'])) {
        
        $camiseta = (int)$_POST['camiseta'];
        //echo "idJugador: '$idJugador' idEquipo: '$idEquip' camiseta: $camiseta";
        $consulta = $conexion->query("SELECT * FROM jugadores WHERE equipo='$idEquip'");
        $consulta=$consulta->fetchAll();
        foreach ($consulta as $equipo) {
            $aux=(int)$equipo['camiseta'];
            if($aux==$camiseta){
                echo  '<h1>Esa camiseta esta ocupada, elige otra</h1>';
            }else{
                echo "idJugador='$idJugador'&idEquipo='$idEquip'&camiseta='$camiseta'";
                header("Location: ./php/transfiriendoEntrenador.php?idJugador=$idJugador&idEquipo=$idEquip&cami=$camiseta");
            }
        }
         }
    
}elseif($_SESSION['rol']=='administrador'){
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

?>


