<?php
 include_once __DIR__ . '/header.php';?>
    <div class="contenedor-sm">
        <div class="contenedor-nueva-tarea">
            <button id="agregar-tarea" class="agregar-tarea" type="button">
            &#x2B; Nueva Tarea
            </button>
            <input type="hidden" name="id" value="<?php echo $proyecto->id;?>">
        </div>
        <div class="filtros" id="filtros">
            <div class="filtros-inputs">
                <h2>Filtros: </h2>
                <div class="campo">
                    <label for="todas">Todas</label>
                    <input type="radio" id="todas" name="filtro" value="" checked>
                </div>
                <div class="campo">
                    <label for="completadas">Completas</label>
                    <input type="radio" id="completadas" name="filtro" value="1" >
                </div>
                <div class="campo">
                    <label for="pendientes">Pendientes</label>
                    <input type="radio" id="pendientes" name="filtro" value="0" >
                </div>
            </div>
        </div>
        <ul class="listado-tareas" id="listado-tareas">
            
        </ul>
    </div>
<?php include __DIR__ . '/footer.php'; ?>
<?php 
    $script .=
        '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/build/js/tareas.js"></script>
    '; 
?>