<div id="myModal" class="modal">
  <div class="modal-content">
    <h2>¿Estás registrado?</h2>
    <button id="yesbtn">Sí, estoy registrado</button>
    <button id="nobtn">No, quiero registrarme</button>
  </div>
</div>

<div class="container">
  <div>
    <form id="registro-form" class="hidden">
      <div class="input-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
      </div>
      <div class="input-group">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido">
      </div>
      <div class="input-group">
        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo">
      </div>
      <div class="input-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
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
      <button type="submit">Registrarse</button>

    </form>
    
      <button onclick="window.location.href='/vistas/index.php'">Inicio</button>
  
  </div>

  <form id="login-form" class="hidden">
    <div class="input-group">
      <label for="username">Usuario o Correo Electrónico:</label>
      <input type="text" id="username" name="username">
    </div>
    <div class="input-group">
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password">
    </div>
    <button type="submit">Iniciar Sesión</button>
  </form>
  
</div>
<script src="js/scripts.js"></script>