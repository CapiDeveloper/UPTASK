<?php
 include_once __DIR__ . '/header.php';?>

 <?php if (count($proyectos) === 0) { ?>
    <p class="no-proyectos">No hay proyectos aun</p>        
<?php }else { ?>   
    <ul class="proyectos"> 
        <?php foreach($proyectos as $proyecto){ ?>
            <li class="proyecto">
                <a href="/proyecto?id=<?php echo $proyecto->url;?>"><?php echo $proyecto->nombre; ?></a>
                <img src="/build/img/bombilla.png" alt="bombilla" width="35px" height="35px">
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<?php include __DIR__ . '/footer.php'; ?>