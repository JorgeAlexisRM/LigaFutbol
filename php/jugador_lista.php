<?php
    //Se crea la conexion
    $db = conexion();
    //Se hace referencia a la coleccion a consular
    $jugadoresRef = $db->collection('jugadores');
    $equipoRef = $db->collection('equipos');
    //Capturar los documentos
    $snapshot = $jugadoresRef->documents();
    $snapshotE = $equipoRef->documents();
    //Ciclo para recorrer la colecccion
    foreach ($snapshot as $jugador) {
        $idRef = $jugador['equipo'] ;
        echo '<p>Nombre: '.$jugador['nombre'].'</p>';
        echo '<p>Apellido: '.$jugador['apellido'].'</p>';
        echo '<p>Edad: '.$jugador['edad'].'</p>';
        echo '<p>Posicion: '.$jugador['posicion'].'</p>';
        foreach ($snapshotE as $equipo){
            $idConsulta = $equipo->id();
            if($idRef===$idConsulta){
                echo '<p>Equipo: '.$equipo['nombre'].'</p>';
                break;
            }else{
                echo '<p>Equipo: ---</p>';
            }
        }
    }