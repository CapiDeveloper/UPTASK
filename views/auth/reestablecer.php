<div class="contenedor reestablecer">
<?php include_once __DIR__.'/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>
        <?php include_once __DIR__.'/../templates/alertas.php' ?>
        <?php if($mostrar){?>
        <form method="POST" class="formulario">
            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </div>
            <input type="submit" value="Guardar Password" class="boton">
        </form>
        <?php } ?>
        <div class="acciones">
            <a href="/crear-cuenta">¿Aun no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div><!--Contenedor sm-->
</div>