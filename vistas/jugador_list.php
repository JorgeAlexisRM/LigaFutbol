<main>
    <div>
        <h1 class="titulo">Lista de Jugadores</h1>
    </div>
    <div class="contenedor">
        <div class="izquierda">
            <?php
            require_once "./php/main.php";
            require_once './php/jugador_lista.php';
            ?>
        </div>
        <div class="derecha">
            <form method="post">
                <div class="search">
                    <input placeholder="Ingresa el nombre..." type="text" id="nombre" name="nombre">
                    <button class="btnSearch" type="submit" value="Buscar" name="busqueda">Buscar</button>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["busqueda"])) {
                    require_once './php/jugador_busqueda.php';
                }
                ?>
            </form>
            <br>
        </div>
    </div>
</main>