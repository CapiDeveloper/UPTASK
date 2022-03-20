<?php include_once __DIR__ . '/header.php';?>
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form class="formulario" action="/crear-proyecto" method="POST">
            <?php include_once __DIR__ . '/../dashbord/formulario-proyecto.php'; ?>
            <input type="submit" value="Crear Proyecto">
        </form>
    </div>
<?php include __DIR__ . '/footer.php'; ?>