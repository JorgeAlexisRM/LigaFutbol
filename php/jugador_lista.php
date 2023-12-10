<?php
$item = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ligachachis";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM jugadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$item .= '<div class="item">
			<img src="' . $row['img'] . '" style="width: 120px; height: 85px;">
            <label>' . $row['nombre'] . '</label>
			<label>' . $row['apellido'] . '</label>
            <label>' . $row['edad'] . ' años' . '</label>
			<label>' . $row['equipo'] . '</label>
            <label>' . $row['camiseta'] . '</label>
			<label>' . $row['posicion'] . '</label>
			<a href="infoJugador.php?id='. $row['idJugador'] .'">
  				<img src="../img/inf.png" style="width: 35px; height: 35px; margin-top: 24px">
			</a>
            </div>';
	}
	echo $item;
}
