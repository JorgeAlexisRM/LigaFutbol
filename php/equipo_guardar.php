<?php

    require_once "../inc/session_start.php";

    require_once "main.php";

    /* Almacenando datos */
    $nombre = $_POST['equipo_nombre'];

    /**Verificando campos obligatorios */
    if($nombre==""){
        echo '
            <div>
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando nombre ==*/
    $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT nombre FROM equipos WHERE nombre='$nombre'");
    if($check_nombre->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_nombre=null;

    /* Directorios de imagenes */
	$img_dir='../img/equipos/';

    /*== Comprobando si se ha seleccionado una imagen ==*/
	if($_FILES['equipo_foto']['name']!="" && $_FILES['equipo_foto']['size']>0){

        /* Creando directorio de imagenes */
        if(!file_exists($img_dir)){
            if(!mkdir($img_dir,0777)){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Error al crear el directorio de imagenes
                    </div>
                ';
                exit();
            }
        }

		/* Comprobando formato de las imagenes */
		if(mime_content_type($_FILES['equipo_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['equipo_foto']['tmp_name'])!="image/png"){
			echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La imagen que ha seleccionado es de un formato que no está permitido
                </div>
            ';
            exit();
		}

        /* Comprobando que la imagen no supere el peso permitido */
        if(($_FILES['equipo_foto']['size']/1024)>3072){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La imagen que ha seleccionado supera el límite de peso permitido
                </div>
            ';
            exit();
        }


        /* extencion de las imagenes */
        switch(mime_content_type($_FILES['equipo_foto']['tmp_name'])){
            case 'image/jpeg':
            $img_ext=".jpg";
            break;
            case 'image/png':
            $img_ext=".png";
            break;
        }

        /* Cambiando permisos al directorio */
        chmod($img_dir, 0777);

        /* Nombre de la imagen */
        $img_nombre=renombrar_fotos($nombre);

        /* Nombre final de la imagen */
        $foto=$img_nombre.$img_ext;

        /* Moviendo imagen al directorio */
        if(!move_uploaded_file($_FILES['equipo_foto']['tmp_name'], $img_dir.$foto)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
                </div>
            ';
            exit();
        }

    }else{
    $foto="";
    }


    /*== Guardando datos ==*/
    $guardar_equipo=conexion();
    $guardar_equipo=$guardar_equipo->prepare("INSERT INTO equipos(idEquipo,nombre,afavor,contra,empatados,ganados,puntos,perdidos,foto) VALUES(:idEquipo,:nombre,:afavor,:contra,:empatados,:ganados,:puntos,:perdidos,:foto)");


    $codigo = uniqid("equipo");

    $marcadores=[
    ":idEquipo"=>$codigo,
    ":nombre"=>$nombre,
    ":afavor"=>0,
    ":contra"=>0,
    ":empatados"=>0,
    ":ganados"=>0,
    ":puntos"=>0,
    ":perdidos"=>0,
    ":foto"=>$foto
    ];

    $guardar_equipo->execute($marcadores);

    if($guardar_equipo->rowCount()==1){
    echo '
        <div class="notification is-info is-light">
            <strong>¡PRODUCTO REGISTRADO!</strong><br>
            El producto se registro con exito
        </div>
    ';
    }else{

    if(is_file($img_dir.$foto)){
        chmod($img_dir.$foto, 0777);
        unlink($img_dir.$foto);
    }

    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo registrar el producto, por favor intente nuevamente
        </div>
    ';
    }
    $guardar_equipo=null;


