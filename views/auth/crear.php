<div class="contenedor crear">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>
        <?php include_once __DIR__.'/../templates/alertas.php'; ?>
        <form method="POST" class="formulario" action="/crear-cuenta">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Email: </label>
                <input type="email" placeholder="Tu Email" id="email" name="email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </div>
            <div class="campo">
                <label for="password2">Repetir password:</label>
                <input type="password" id="password2" placeholder="Repite tu password" name="password2">
            </div>
            <input type="submit" value="Iniciar Session" class="boton">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar session</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div><!--Contenedor sm-->
</div>