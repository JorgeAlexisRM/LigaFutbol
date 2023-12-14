<?php
$item = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ligachachis";

$conn = new mysqli($servername, $username, $password, $dbname);
$conexion = conexion();



$sql = "SELECT * FROM jugadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$idEquipo=$row['equipo'];
		$consulta_equipos= "SELECT * FROM equipos WHERE idEquipo='$idEquipo'";
		$equipo=$conexion->query($consulta_equipos);
		$equipo=$equipo->fetch();
		if($equipo){
		$item .= '<div class="item">
			<img src="./img/puma.png" style="width: 120px; height: 85px;">
            <label>' . $row['nombre'] . '</label>
			<label>' . $row['apellido'] . '</label>
            <label>' . $row['edad'] . ' años' . '</label>
			<label>' . $equipo['nombre'] . '</label>
            <label>' . $row['camiseta'] . '</label>
			<label>' . $row['posicion'] . '</label>
			';
		}else{
			$item .= '<div class="item">
			<img src="./img/puma.png" style="width: 120px; height: 85px;">
            <label>' . $row['nombre'] . '</label>
			<label>' . $row['apellido'] . '</label>
            <label>' . $row['edad'] . ' años' . '</label>
			<label>X</label>
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
	}
	echo $item;
}