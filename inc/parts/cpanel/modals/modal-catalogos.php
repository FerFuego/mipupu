<!-- Modal -->
<div class="modal fade" id="catalogoModal" tabindex="-1" role="dialog" aria-labelledby="catalogoModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="catalogoModalLabel">Catálogo PDF</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="cleanCatalogoModal();" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-cli" id="js-form-catalogo" enctype="multipart/form-data">
					<input type="hidden" name="type" id="type_catalogo" value="new">
					<input type="hidden" name="id_catalogo" id="id_catalogo" value="">
					
                    <div class="form-group">
						<label for="id_marca">Marca Asociada</label>
						<select name="id_marca" id="id_marca_catalogo" class="form-control" required style="display: block; width: 100%;">
                            <option value="">Seleccione una Marca</option>
                            <?php 
                                $marcasCls = new Marcas();
                                $marcas = $marcasCls->getMarcas();
                                while ($m = $marcas->fetch_object()): ?>
                                    <option value="<?php echo $m->Id_Marca; ?>"><?php echo $m->Nombre; ?></option>
                            <?php endwhile; ?>
                        </select>
					</div>
					
					<div class="form-group">
						<label for="titulo">Título del Catálogo</label>
						<input type="text" name="titulo" id="titulo_catalogo" class="form-control" required>
					</div>

                    <div class="form-group">
                        <label for="archivo_pdf">Archivo PDF</label>
                        <input type="file" name="archivo_pdf" id="archivo_pdf_catalogo" class="form-control-file" accept="application/pdf">
                        <small class="form-text text-muted">Sólo se aceptan archivos PDF. Si está editando, déjelo vacío para mantener el archivo actual.</small>
                    </div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="cleanCatalogoModal();" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="submitCatalogoForm();">Guardar Cambios</button>
			</div>
		</div>
	</div>
</div>

<script>
    function cleanCatalogoModal() {
        $('#js-form-catalogo')[0].reset();
        $('#type_catalogo').val('new');
        $('#id_catalogo').val('');
        // resetea select si usan styled dropdowns
    }

    function editCatalogoModal(el) {
        cleanCatalogoModal();
        var id = $(el).data('id');
        var marca = $(el).data('marca');
        var titulo = $(el).data('titulo');

        $('#type_catalogo').val('edit');
        $('#id_catalogo').val(id);
        $('#id_marca_catalogo').val(marca);
        $('#titulo_catalogo').val(titulo);
    }

    function submitCatalogoForm() {
        var formData = new FormData($('#js-form-catalogo')[0]);
        formData.append('action', 'save_catalogo');

        $.ajax({
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status == 'success') {
                    location.reload();
                } else {
                    alert("Error: " + res.message);
                }
            }
        });
    }

    function deleteCatalogo(id) {
        if(confirm("¿Seguro que deseas eliminar este catálogo?")) {
            $.ajax({
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: { action: 'delete_catalogo', id: id },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        location.reload();
                    } else {
                        alert("Error: " + res.message);
                    }
                }
            });
        }
    }
</script>
