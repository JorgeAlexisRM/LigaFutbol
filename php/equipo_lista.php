<?php
    //Se crea la conexion
    $db = conexion();
    //Se hace referencia a la coleccion a consular
    $equipoRef = $db->collection('equipos');
    //Capturar los documentos
    $snapshot = $equipoRef->documents();
    //Ciclo para recorrer la colecccion
    foreach ($snapshot as $equipo) {
        echo '<p>Nombre: '.$equipo['nombre'].'</p>';
        echo '<p>PTS: '.$equipo['puntos'].'</p>';
        echo '<p>PJ: '.$equipo['jugados'].'</p>';
        echo '<p>PG: '.$equipo['ganados'].'</p>';
        echo '<p>PP: '.$equipo['perdidos'].'</p>';
        echo '<p>PE: '.$equipo['empatados'].'</p>';
        echo '<p>GA: '.$equipo['afavor'].'</p>';
        echo '<p>GC: '.$equipo['contra'].'</p>';
    }