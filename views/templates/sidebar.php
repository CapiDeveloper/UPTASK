<aside class="sidebar">
    <div class="contenedor-sidebar">
            <h2>UPTASK</h2>
            <div class="cerrar-menu">
                <img id="cerrar-menu" src="/build/img/cerrarMenu.svg" alt="Icono cerrar menu">   
            </div>
    </div>
    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Proyectos') ? 'activo':''; ?>" href="/dashbord">Proyectos</a>
        <a class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo':''; ?>" href="/crear-proyecto">Crear Proyecto</a>
        <a class="<?php echo ($titulo === 'Perfil') ? 'activo':''; ?>" href="/perfil">Perfil</a>
    </nav>
    <div class="cerrar-session-mobile">
        <a href="/logout" class="cerrar-session">Cerrar Session</a>
    </div>
</aside>