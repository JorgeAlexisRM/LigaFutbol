
  <!-- Contenido del encabezado -->
  <header>
    <img class="logo" src="img/Laliga.webp" alt="Logo de la página">
      <nav>
        <ul class="menu">
          <li><a href="index.php?vista=home">Inicio</a></li>
          <li><a href="index.php?vista=equipos_list">Equipos</a></li>
          <li><a href="index.php?vista=jugador_list">Jugadores</a></li>
          <li><a href="index.php?vista=partidos_list">Partidos</a></li>
          <li><a href="index.php?vista=tabla_posiciones">Tabla de Posiciones</a></li>
          <?php 
            if (isset($_SESSION['usuario'])) {
              echo '<li><a href="index.php?vista=perfil">Perfil</a></li>';
            }
          ?>
          <li>
            <?php 
              if (isset($_SESSION['usuario'])) {
                echo '<a href="index.php?vista=logout"> Cerrar Sesión</a>';
              }else{
                echo '<button onclick="window.location.href=\'index.php?vista=login\'">
                  <div class="text">
                    <span>Regístrate</span>
                  </div>
                  <div class="clone">
                    <a>Regístrate</a>
                  </div>
                  <svg width="20px" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                  </svg>
                  </button> ';
              }
            ?>
          </li>
        </ul>
      </nav>
  </header>