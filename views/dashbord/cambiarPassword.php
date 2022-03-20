<?php include_once __DIR__ . '/header.php';?>
    <div class="contenedor-sm">

        <a class="enlace" href="/perfil">Volver a Perfil</a>

        <?php include_once __DIR__ .'/../templates/alertas.php';?>   
        
        <form method="POST" action="/cambiar-password" class="formulario">
            <div class="campo">
                <label for="password">Password Actual: </label>
                <input type="password" name="password_actual" id="password" placeholder="Tu password actual" >
            </div>
            <div class="campo">
                <label for="passwordN">Nuevo Password: </label>
                <input type="password" name="password_nuevo" id="passwordN" placeholder="Tu password nuevo">
            </div>
            <input type="submit" value="Actualizar">
        </form>
    </div>
<?php include __DIR__ . '/footer.php'; ?>