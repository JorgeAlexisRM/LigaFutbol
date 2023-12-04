<?php
    //Se crea la conexion
    $db = conexion();
    //Se hace referencia a la coleccion a consular
    $usersRef = $db->collection('jugadores');
    //Referencia al documento a consultar
    $docRef = $usersRef->document('K2rokcGftLIFMk7c4TFt');
    //Recupéra todo los datos del coumento
    $snapshot = $docRef->snapshot();
    //Obtiene solo el nombre
    $nombre = $snapshot['nombre'];

    //Imprime solo un atrubuto nombre
    printf('Document data:' . PHP_EOL);
    print((string) $nombre);
    //Imprime toda la cadena
    printf('Document data:' . PHP_EOL);
    print_r($snapshot->data());

    /*
    $snapshot = $usersRef->documents();
    foreach ($snapshot as $user) {
        echo '<p>'.$user['nombre'].'<p>';
        echo '<p>'.$user['apellido'].'<p>';
        echo '<p>'.$user['edad'].'<p>';
        echo '<p>'.$user['posicion'].'<p>';
        *//*
        printf('Nombre: %s' . PHP_EOL, $user['nombre']);
        printf('Apellido: %s' . PHP_EOL, $user['apellido']);
        printf('Edad: %s' . PHP_EOL, $user['edad']);
        printf('Posicion: %s' . PHP_EOL, $user['posicion']);
        printf(PHP_EOL);*/
    //}
    printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);
