<div class="campo">
    <label for="nombre">Nombre Proyecto: </label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre del Proyecto" value="<?php echo $proyecto->nombre; ?>">
</div>
<div class="campo">
    <label for="descripcion">Descripcion: </label>
    <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $proyecto->descripcion; ?>">
</div>
<div class="campo">
    <label for="cotizacion">Cotizacion: </label>
    <input type="number" name="cotizacion" id="cotizacion" placeholder="Cotizacion" value="<?php echo $proyecto->cotizacion; ?>">
</div>