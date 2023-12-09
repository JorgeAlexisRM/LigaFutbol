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