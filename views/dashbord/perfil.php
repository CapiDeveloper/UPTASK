<?php include_once __DIR__ . '/header.php';?>
    <div class="contenedor-sm">
    <a class="enlace" href="/cambiar-password">Cambiar Contraseña</a>

        <?php include_once __DIR__ .'/../templates/alertas.php';?>   
        
        <form method="POST" action="/perfil" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Tu email" value="<?php echo $usuario->email; ?>">
            </div>
            <input type="submit" value="Actualizar">
        </form>
    </div>
<?php include __DIR__ . '/footer.php'; ?>