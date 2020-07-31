<h1>Gestión de productos</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">
	Crear producto
</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
	<strong class="alert_green"> El producto ha sido creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
	<strong class="alert_red"> El producto NO se ha sido creado correctamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('producto'); ?>

<table border="1">
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
	</tr>
<?php while ($pro = $productos->fetch_object()):  ?>
	<tr>
		<td><?=$pro->id;?></td>
		<td><?=$pro->nombre;?></td>
		<td><?=$pro->precio;?></td>
		<td><?=$pro->stock;?></td>
	</tr>	
<?php endwhile; ?>
</table>