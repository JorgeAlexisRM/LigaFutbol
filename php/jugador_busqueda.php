<?php
$item = "";
$imf = "./img/inf.png";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ligachachis";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'])) {
        $nombreJugador = $_POST['nombre'];

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT * FROM jugadores WHERE nombre = '$nombreJugador'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idEquipo = $row['equipo'];
            $consulta="SELECT * FROM equipos WHERE idEquipo='$idEquipo'";
            $equipos = $conn->query($consulta);
            $equipos = $equipos->fetch_assoc();
            $equipo = $row['equipo'];
            if ($equipo == null) {
                if ($result_equipo->num_rows > 0) {
                    ($row_equipo = $result_equipo->fetch_assoc());
                }
                $item .= '<div class="item">
			            <img src="./img/equipos/equipo.png' . '" style="width: 60px; height: 60px;">
                        <label>' . $row['nombre'] . '</label>
			            <label>' . $row['apellido'] . '</label>
                        <label>' . $row['edad'] . ' años' . '</label>
			            <label>' . $row['equipo'] . '</label>
                        <label>' . $row['camiseta'] . '</label>
			            <label>' . $row['posicion'] . '</label>
			            ';
            } else {
                $sql_equipo = "SELECT foto FROM equipos WHERE idequipo = '$equipo'";
                $result_equipo = $conn->query($sql_equipo);
                if ($result_equipo->num_rows > 0) {
                    ($row_equipo = $result_equipo->fetch_assoc());
                }
                $item .= '<div class="item">
			            <img src="./img/equipos/' . $row_equipo['foto'] . '" style="width: 60px; height: 60px;">
                        <label>' . $row['nombre'] . '</label>
			            <label>' . $row['apellido'] . '</label>
                        <label>' . $row['edad'] . ' años' . '</label>
			            <label>' . $equipos['nombre'] . '</label>
                        <label>' . $row['camiseta'] . '</label>
			            <label>' . $row['posicion'] . '</label>
			        ';
            }
            if(isset($_SESSION['rol'])&&($_SESSION['rol']==='administrador' || $_SESSION['rol']==='entrenador')){
                $item.='<a href="index.php?vista=infoJugador&idJugador='. $row['idJugador'] .'&idEquipo='.$row['equipo'].'">
                <img src="./img/inf.png" style="width: 35px; height: 35px; margin-top: 24px">
                </a>
                </div>';
            }else{
                $item.='</div>';
            }

            echo $item;
        } else {
            echo '<h1 class="error">' . 'No se encontro al jugador' . '</h1>';
        }

        $conn->close();
    }
}
