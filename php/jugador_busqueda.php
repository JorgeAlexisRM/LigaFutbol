<?php
$item = "";
$imf="../img/inf.png";
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
            while ($row = $result->fetch_assoc()) {
                $item .= '<div class="item">
                    <img src="'. $row['img'] . '" style="width: 120px; height: 85px;">
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
        } else {
            echo '<h1 class="error">'.'No se encontro al jugador'.'</h1>';
        }

        $conn->close();
    }
}
