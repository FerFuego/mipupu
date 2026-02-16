<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="productModalLabel">Productos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-cli" id="js-form-prod" enctype="multipart/form-data">
					<input type="hidden" name="type_prod" id="type_prod" value="edit">
					<div class="form-group">
						<label for="name">Cod Producto</label>
						<input type="text" name="cod_prod" id="cod_prod">
					</div>
					<div class="form-group">
						<label for="image">Imagen del Producto</label>
						<input type="file" name="image" id="image" class="form-control" accept="image/*">
					</div>
					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" name="name_prod" id="name_prod">
					</div>
					<div class="form-group">
						<label for="news">Novedad</label>
						<select class="form-control" name="news" id="news">
							<option value="">Seleccione</option>
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</div>
					<div class="form-group">
						<label for="offer">Oferta</label>
						<select class="form-control" name="offer" id="offer">
							<option value="">Seleccione</option>
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</div>
					<div class="form-group mt-3">
						<label for="observation">Observaciones</label>
						<input type="text" name="observation" id="observation">
					</div>
					<div class="form-group">
						<label for="id_marca">Marca</label>
						<select class="form-control" name="id_marca" id="id_marca"
							onchange="$('#marca').val($('#id_marca option:selected').text())">
							<option value="">Seleccione</option>
							<?php
							$marcas = new Marcas();
							$result_m = $marcas->getMarcas();
							while ($m = $result_m->fetch_object()): ?>
								<option value="<?php echo $m->Id_Marca; ?>">
									<?php echo $m->Nombre; ?>
								</option>
							<?php endwhile; ?>
						</select>
						<input type="hidden" name="marca" id="marca">
					</div>
					<div class="form-group">
						<label for="id_clasificacion">Clasificación</label>
						<select class="form-control" name="id_clasificacion" id="id_clasificacion"
							onchange="$('#clasificacion').val($('#id_clasificacion option:selected').text())">
							<option value="">Seleccione</option>
							<?php
							$clasificaciones = new Clasificaciones();
							$result_c = $clasificaciones->getClasificaciones();
							while ($c = $result_c->fetch_object()): ?>
								<option value="<?php echo $c->Id_Clasificacion; ?>">
									<?php echo $c->Nombre; ?>
								</option>
							<?php endwhile; ?>
						</select>
						<input type="hidden" name="clasificacion" id="clasificacion">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="$('#js-form-prod').submit();">Guardar
					Cambios</button>
			</div>
		</div>
	</div>
</div>