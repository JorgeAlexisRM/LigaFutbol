<?php
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once 'main.php';

$item = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ligachachis";

$conn = new mysqli($servername, $username, $password, $dbname);
$conexion = conexion(); // Asumiendo que tienes una función llamada "conexion" que establece la conexión a la base de datos


$pdf = new TCPDF(); // Crear una instancia de TCPDF

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Lista de Jugadores');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$sql = "SELECT * FROM jugadores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generar el contenido para cada jugador
        $idEquipo = $row['equipo'];
        $consulta_equipos = "SELECT * FROM equipos WHERE idEquipo='$idEquipo'";
        $equipo = $conexion->query($consulta_equipos);
        $equipo = $equipo->fetch();

        if ($equipo) {
            $item .= '<div class="item">
                <img src="./img/puma.png" style="width: 120px; height: 85px;">
                <label>' . $row['nombre'] . '</label>
                <label>' . $row['apellido'] . '</label>
                <label>' . $row['edad'] . ' años' . '</label>
                <label>' . $equipo['nombre'] . '</label>
                <label>' . $row['camiseta'] . '</label>
                <label>' . $row['posicion'] . '</label>
                </div>';
        } else {
            $item .= '<div class="item">
                <img src="./img/puma.png" style="width: 120px; height: 85px;">
                <label>' . $row['nombre'] . '</label>
                <label>' . $row['apellido'] . '</label>
                <label>' . $row['edad'] . ' años' . '</label>
                <label>X</label>
                <label>' . $row['camiseta'] . '</label>
                <label>' . $row['posicion'] . '</label>
                </div>';
        }
    }
}

$pdf->writeHTML($item); // Agregar el contenido al PDF

ob_end_clean();
$pdf->Output('lista_jugadores.pdf', 'D'); // Descargar el PDF generado con el nombre "lista_jugadores.pdf"

// Redirige a la página principal o a donde desees después del UPDATE
header('Location: ../index.php?vista=jugador_list');
exit();
?>