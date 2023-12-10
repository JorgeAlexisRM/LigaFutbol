<?php
    
    require_once "main.php";

    /*== Almacenando datos ==*/
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];

    $usuario=$_POST['username'];
    $contraseña=$_POST['password'];
    $contraseña2=$_POST['password2'];

    $rol=$_POST['tipo'];


    /*== Verificando campos obligatorios ==*/
    if($nombre=="" || $apellido=="" || $usuario=="" || $contraseña=="" || $contraseña2=="" || $rol==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contraseña) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contraseña2) ){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CONTRASEÑAS no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    /*== Verificando usuario ==*/
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT username FROM usuarios WHERE username='$usuario'");
    if($check_usuario->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_usuario=null;


    /*== Verificando claves ==*/
    if($contraseña!=$contraseña2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CONTRASEÑAS que ha ingresado no coinciden
            </div>
        ';
        exit();
    }else{
        $clave=password_hash($contraseña,PASSWORD_BCRYPT,["cost"=>10]);
    }



    /*== Guardando datos ==*/
    $guardar_usuario=conexion();
    $guardar_usuario=$guardar_usuario->prepare("INSERT INTO usuarios(idUsuario,rol,contraseña,username,nombre,apellido) VALUES(:idUsuario,:rol,:contrasena,:username,:nombre,:apellido)");

    $codigo = uniqid("user");

    $marcadores=[
        ":idUsuario"=>$codigo,
        ":rol"=>$rol,
        ":contrasena"=>$clave,
        ":username"=>$usuario,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido
    ];

    $guardar_usuario->execute($marcadores);

    if($guardar_usuario->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO REGISTRADO!</strong><br>
                El usuario se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_usuario=null;