
<!-- formulario equipo nuevo -->
<main>
    <div class="titulosForm">
        <h1>Equipos</h1>
        <h2>Nuevo equipo</h2>
    </div>

    <div class="form-rest"></div>

    <div class="formularioEquipo">
        <form action="./php/equipo_guardar.php" class="FormularioAjax" method="POST" autocomplete="off" enctype="multipart/form-data" >
            
            <div class="nombre">
                <label for="nombre">Nombre del equipo: </label><br>
                <input name="equipo_nombre" type="text">
            </div>

            <div>
                <div>
                    <label>Escudo o Logo del equipo</label><br>
                    <div>
                        <label>
                            <input type="file" name="equipo_foto" accept=".jpg, .png, .jpeg" >
                            <span>
                                <span>Imagen</span>
                            </span>
                            <span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
                        </label>
                    </div>
                </div>
            </div>
            <p>
                <button type="submit">Guardar</button>
            </p>
        </form>
    </div>
</main>