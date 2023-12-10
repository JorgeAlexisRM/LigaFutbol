<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $idPartido=$_POST['idPartido'];


    /*== Verificando partido ==*/
	$check_partido=conexion();
	$check_partido=$check_partido->query("SELECT * FROM partidos WHERE idPartido='$idPartido'");

    if($check_partido->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El partido no existe en la jornada
            </div>
        ';
        exit();
    }else{
    	$datos=$check_partido->fetch();
    }
    $check_partido=null;


    /*== Almacenando datos ==*/
    $marcadorLocal=$_POST['marcadorLocal'];
	$marcadorVisitante=$_POST['marcadorVisitante'];

	/*== Verificando campos obligatorios ==*/
    if($marcadorLocal=="" || $marcadorVisitante==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado los campos del marcador
            </div>
        ';
        exit();
    }

    /*== Actualizando partido ==*/
    $actualizar_partido=conexion();
    $actualizar_partido=$actualizar_partido->prepare("UPDATE partidos SET marcadorLocal=:marcadorLocal, marcadorVisitante=:marcadorVisitante, jugado=:jugado WHERE idPartido=:idPartido");

    $marcadores=[
        ":marcadorLocal"=>$marcadorLocal,
        ":marcadorVisitante"=>$marcadorVisitante,
        ":jugado"=>1,
        ":idPartido"=>$idPartido
    ];


    if($actualizar_partido->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>PARTIDO ACTUALIZADO!</strong><br>
                El producto se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el partido, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_partido=null;

    /**Actualizando equipos */
    /**Obteniendo datos del equipoLocal */
    $idEquipoLocal=$datos['equipolocal'];
    $check_equipoLocal=conexion();
    $check_equipoLocal=$check_equipoLocal->query("SELECT * FROM equipos WHERE idEquipo='$idEquipoLocal'");
    if($check_equipoLocal->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El equipo no existe
            </div>
        ';
        exit();
    }else{
    	$datosLocal=$check_equipoLocal->fetch();
        $afavorLocal=$datosLocal['afavor'];
        $contraLocal=$datosLocal['contra'];
        $empatadosLocal=$datosLocal['empatados'];
        $ganadosLocal=$datosLocal['ganados'];
        $puntosLocal=$datosLocal['puntos'];
        $perdidosLocal=$datosLocal['perdidos'];
    }
    $check_equipoLocal=null;

    /**Obteniendo datos del equipoVisitante */
    $idEquipoVisitante=$datos['equipoVisitante'];
    $check_equipoVisitante=conexion();
    $check_equipoVisitante=$check_equipoVisitante->query("SELECT * FROM equipos WHERE idEquipo='$idEquipoVisitante'");
    if($check_equipoVisitante->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El equipo no existe
            </div>
        ';
        exit();
    }else{
    	$datosVisitante=$check_equipoVisitante->fetch();
        $afavorVisitante=$datosVisitante['afavor'];
        $contraVisitante=$datosVisitante['contra'];
        $empatadosVisitante=$datosVisitante['empatados'];
        $ganadosVisitante=$datosVisitante['ganados'];
        $puntosVisitante=$datosVisitante['puntos'];
        $perdidosVisitante=$datosVisitante['perdidos'];
    }
    $check_equipoVisitante=null;

    echo $marcadorLocal;
    echo $marcadorVisitante;

    /**Modificando datos de los equipos */
    /**Marcador diferente de 0-0*/
    if($marcadorLocal!=0 || $marcadorVisitante!=0){
        /**Goles a favor */
        $afavorLocal+=$marcadorLocal;
        $afavorVisitante+=$marcadorVisitante;
        /**Goles en contra */
        $contraLocal+=$marcadorVisitante;
        $contraVisitante+=$marcadorLocal;
        if($marcadorLocal==$marcadorVisitante){
            /**Partido empatado */
            $empatadosLocal+=1;
            $empatadosVisitante+=1;
            /**1 punto para cada equipo */
            $puntosLocal+=1;
            $puntosVisitante+=1;
        }elseif($marcadorLocal>$marcadorVisitante){
            /**Partido Ganado por equipo local */
            $ganadosLocal+=1;
            $perdidosVisitante+=1;
            /**3 puntos para el equipo local */
            $puntosLocal+=3;
        }else{
            /**Partido Ganado por equipo visitante */
            $ganadosVisitante+=1;
            $perdidosLocal+=1;
            /**3 puntos para el equipo visitante */
            $puntosVisitante+=3;
        }
    }else{ /**Marcador igual a 0-0 */
        /**Partido empatado */
        $empatadosLocal+=1;
        $empatadosVisitante+=1;
        /**1 punto para cada equipo */
        $puntosLocal+=1;
        $puntosVisitante+=1;
    }

    /** */
    $actualizar_equipos=conexion();
    $actualizar_equipos=$actualizar_equipos->prepare("UPDATE equipos SET afavor=:afavor,contra=:contra, empatados=:empatados, ganados=:ganados, perdidos=:perdidos, puntos=:puntos WHERE idEquipo=:idEquipo");

    /**Equipo local */
    $marcadores=[
        ":afavor"=>$afavorLocal,
        ":contra"=>$contraLocal,
        ":empatados"=>$empatadosLocal,
        ":ganados"=>$ganadosLocal,
        ":puntos"=>$puntosLocal,
        ":perdidos"=>$perdidosLocal,
        ":idEquipo"=>$idEquipoLocal
    ];

    if($actualizar_equipos->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EQUIPO LOCAL ACTUALIZADO!</strong><br>
                El equipo se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el equipo, por favor intente nuevamente
            </div>
        ';
    }

    /**Equipo visitante */
    $marcadores=[
        ":afavor"=>$afavorVisitante,
        ":contra"=>$contraVisitante,
        ":empatados"=>$empatadosVisitante,
        ":ganados"=>$ganadosVisitante,
        ":puntos"=>$puntosVisitante,
        ":perdidos"=>$perdidosVisitante,
        ":idEquipo"=>$idEquipoVisitante
    ];

    if($actualizar_equipos->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡EQUIPO VISITANTE ACTUALIZADO!</strong><br>
                El equipo se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el equipo, por favor intente nuevamente
            </div>
        ';
    }

    $actualizar_equipos=null;