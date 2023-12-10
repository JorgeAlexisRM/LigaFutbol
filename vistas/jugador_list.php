<title>Jugadores</title>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/jugadores.css">
    <?php require_once "../inc/navbar.php"; ?>
</head>
<div>
    <h1 class="titulo">Lista de Jugadores</h1>
</div>

<body>
    <div class="contenedor">
        <div class="izquierda">
            <?php require_once '../php/jugador_lista.php'; ?>
        </div>
        <div class="derecha">
            <form method="post">
                <div class="search">
                    <input placeholder="Ingresa el nombre..." type="text" id="nombre" name="nombre">
                    <button type="submit" value="Buscar" name="busqueda">Buscar Jugador</button>
                </div>
            </form>
            <br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["busqueda"])) {
                require_once '../php/jugador_busqueda.php';
            }
            ?>
        </div>
        <?php require_once "../php/main.php"; ?>
    </div>

</body>