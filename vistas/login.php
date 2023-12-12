
   <div id="myModal" class="modal">
     <div class="modal-content">
       <h2>¿Estás registrado?</h2>
       <button class="btnMulti" id="yesbtn">Sí, estoy registrado</button>
       <button class="btnMulti" id="nobtn">No, quiero registrarme</button>
     </div>
   </div>
   
 <main>
   <div class="form-rest"></div>

   <div class="container">
     <div>
       <form id="registro-form" class="hidden" method="POST" action="./php/usuario_guardar.php" autocomplete="off">
         <div class="input-group1">
           <label for="nombre">Nombre:</label>
           <input type="text" id="nombre" name="nombre">
         </div>
         <div class="input-group1">
           <label for="apellido">Apellido:</label>
           <input type="text" id="apellido" name="apellido">
         </div>
         <div class="input-group2">
           <label for="username">Username:</label>
           <input type="text" id="username" name="username">
         </div>
         <div class="input-group3">
           <label for="password">Contraseña:</label>
           <input type="password" id="password" name="password">
         </div>
         <div class="input-group">
           <label for="password2">Repite la contraseña:</label>
           <input type="password" id="password2" name="password2">
         </div>
         <div class="radio-group">
           <label>
             <input type="radio" name="tipo" value="jugador">
             Soy Jugador
           </label>
           <label>
             <input type="radio" name="tipo" value="entrenador">
             Soy Entrenador
           </label>
         </div>
         <button class="btnMulti" type="submit">Registrarse</button>
       </form>

     </div>

     <form id="login-form" class="hidden" method="POST" action="">
       <div class="input-group5">
         <label for="username">Usuario:</label>
         <input type="text" id="username" name="username">
       </div>
       <div class="input-group4">
         <label for="password">Contraseña:</label>
         <input type="password" id="password" name="password">
       </div>
       <button class="btnMulti" type="submit">Iniciar Sesión</button>

       <?php
        if (isset($_POST['username']) && isset($_POST['password'])) {
          require_once "./php/main.php";

          require_once "./php/iniciar_sesion.php";
        }
        ?>

     </form>

   </div>
 </main>