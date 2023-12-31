<?php
	/*== Almacenando datos ==*/
    $usuario=$_POST['username'];
    $clave=$_POST['password'];


    /*== Verificando campos obligatorios ==*/
    if($usuario=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$]{6,100}",$clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVE no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuarios WHERE username='$usuario'");
    echo $check_user->rowCount();
    if($check_user->rowCount()===1){

    	$check_user=$check_user->fetch();

        echo $check_user['username'];
        echo "<br>";
        echo $check_user['contraseña'];
        echo "<br>";
        echo $clave;

    	if($check_user['username']===$usuario && password_verify($clave,$check_user['contraseña'])){

    		$_SESSION['id']=$check_user['idUsuario'];
    		$_SESSION['nombre']=$check_user['nombre'];
    		$_SESSION['apellido']=$check_user['apellido'];
    		$_SESSION['usuario']=$check_user['username'];
            $_SESSION['rol']=$check_user['rol'];

            $idUsuario=$check_user['idUsuario'];

            $check_equipo=conexion();
            $check_equipo=$check_equipo->query("SELECT * FROM equipos WHERE idEntrenador='$idUsuario'");
            $check_equipo->rowCount();
            if($check_equipo->rowCount()===1){
                $check_equipo=$check_equipo->fetch();
                $_SESSION['equipo']=$check_equipo['nombre'];
                $_SESSION['idEquipo']=$check_equipo['idEquipo'];
            }

            $check_jugador=conexion();
            $check_jugador=$check_jugador->query("SELECT * FROM jugadores WHERE idJugador='$idUsuario'");
            $check_jugador->rowCount();
            if($check_jugador->rowCount()===1){
                $check_jugador=$check_jugador->fetch();
                $_SESSION['posicion']=$check_jugador['posicion'];
                $_SESSION['camiseta']=$check_jugador['camiseta'];
                $_SESSION['edad']=$check_jugador['edad'];
                $idEquipo = $check_equipo['equipo'];
                $check_equipo=$check_equipo->query("SELECT * FROM equipos WHERE idEquipo='$idEquipo'");
                $check_equipo->rowCount();
                if($check_equipo->rowCount()===1){
                    $check_equipo=$check_equipo->fetch();
                    $_SESSION['equipo']=$check_equipo['nombre'];
                }
            }

    		if(headers_sent()){
				echo "<script> window.location.href='index.php?vista=home'; </script>";
			}else{
				header("Location: index.php?vista=home");
			}

        }else{
    	    echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Usuario o contraseña incorrectos
	            </div>
	        ';
    	}
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Usuario o contraseña incorrectos2
            </div>
        ';
    }
    $check_user=null;
    $check_jugador=null;
    $check_equipo=null;