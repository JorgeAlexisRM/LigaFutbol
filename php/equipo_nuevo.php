<?php
    require_once "main.php";
    $nombre = $_POST['nombre'];
    //creamos la conexion
    $db = conexion();

    $data = [
        'nombre' => $nombre,
        'puntos'=>0,
        'jugados'=>0,
        'ganados'=>0,
        'perdidos'=>0,
        'empatados'=>0,
        'afavor'=>0,
        'contra'=> 0
    ];
    
    $docRef = $db->collection('equipos')->add($datos);