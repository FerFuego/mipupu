<!-- Modal -->
<div class="modal fade" id="verPreventaModal" tabindex="-1" role="dialog" aria-labelledby="verPreventaModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="verPreventaModalLabel">Detalle del Encargo / Preventa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="preventaDetailContainer">
				<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i> Cargando...</div>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btnToggleEstado" onclick="toggleEstadoPreventa();">Marcar como Procesado</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
    var currentPreventaId = 0;
    var currentPreventaEstado = 0;

    function loadPreventaData(el) {
        var id = $(el).data('id');
        currentPreventaId = id;
        $('#preventaDetailContainer').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i> Cargando...</div>');

        $.ajax({
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: { action: 'data_preventa', id: id },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status == 'success') {
                    var p = res.data;
                    currentPreventaEstado = p.Estado;
                    
                    var html = '<table class="table table-bordered">';
                    html += '<tr><th>ID</th><td>#' + p.Id_Preventa + '</td></tr>';
                    html += '<tr><th>Fecha</th><td>' + p.Fecha + '</td></tr>';
                    html += '<tr><th>Cliente</th><td>' + p.Nombre + '</td></tr>';
                    html += '<tr><th>Email</th><td><a href="mailto:'+ p.Email +'">' + p.Email + '</a></td></tr>';
                    html += '<tr><th>Teléfono / WhatsApp</th><td>' + p.Telefono + '</td></tr>';
                    html += '<tr><th>Mensaje</th><td>' + p.Mensaje.replace(/\n/g, '<br>') + '</td></tr>';
                    
                    if(p.Archivo_Imagen && p.Archivo_Imagen.trim() !== '') {
                        html += '<tr><th>Imagen Adjunta</th><td><a href="fotos/preventas/' + p.Archivo_Imagen + '" target="_blank"><img src="fotos/preventas/' + p.Archivo_Imagen + '" style="max-width: 200px; max-height: 200px;" class="img-thumbnail"></a><br><a href="fotos/preventas/' + p.Archivo_Imagen + '" target="_blank">Ver Completo</a></td></tr>';
                    } else {
                        html += '<tr><th>Imagen Adjunta</th><td>Sin Imagen</td></tr>';
                    }

                    html += '</table>';
                    $('#preventaDetailContainer').html(html);

                    if(p.Estado == 0) {
                        $('#btnToggleEstado').text('Marcar como Procesado').removeClass('btn-success').addClass('btn-warning');
                    } else {
                        $('#btnToggleEstado').text('Marcar como Pendiente').removeClass('btn-warning').addClass('btn-success');
                    }
                } else {
                    $('#preventaDetailContainer').html('<div class="alert alert-danger">Error: ' + res.message + '</div>');
                }
            }
        });
    }

    function toggleEstadoPreventa() {
        var nuevoEstado = (currentPreventaEstado == 0) ? 1 : 0;
        $.ajax({
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: { action: 'update_estado_preventa', id: currentPreventaId, estado: nuevoEstado },
            success: function(response) {
                var res = JSON.parse(response);
                if(res.status == 'success') {
                    location.reload();
                } else {
                    alert('Error: ' + res.message);
                }
            }
        });
    }

    function deletePreventa(id) {
        if(confirm("¿Seguro que deseas eliminar el registro de esta preventa?")) {
            $.ajax({
                url: 'inc/functions/ajax-requests.php',
                type: 'POST',
                data: { action: 'delete_preventa', id: id },
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
</script
