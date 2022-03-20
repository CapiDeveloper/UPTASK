<div class="contenedor login">
<?php include_once __DIR__.'/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Session</p>
        <?php include_once __DIR__.'/../templates/alertas.php'; ?>
        <form method="POST" class="formulario" action="/">
            <div class="campo">
                <label for="email">Email: </label>
                <input type="email" placeholder="Tu Email" id="email" name="email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </div>
            <input type="submit" value="Iniciar Session" class="boton">
        </form>
        <div class="acciones">
            <a href="/crear-cuenta">¿Aun no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div><!--Contenedor sm-->
</div>