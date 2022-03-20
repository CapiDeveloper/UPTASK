<div class="contenedor olvide">
    <?php include_once __DIR__.'/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Olvide mi cuenta</p>
        <?php include_once __DIR__.'/../templates/alertas.php' ?>
        <form method="POST" class="formulario" action="/olvide">
            <div class="campo">
                <label for="email">Email: </label>
                <input type="email" placeholder="Tu Email" id="email" name="email">
            </div>
            <input type="submit" value="Enviar Instrucciones" class="boton">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar session</a>
            <a href="/crear-cuenta">¿No tienes una cuenta? Crea una</a>
        </div>
    </div><!--Contenedor sm-->
</div>