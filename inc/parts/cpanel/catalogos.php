<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <button data-toggle="modal" onclick="cleanCatalogoModal();" data-target="#catalogoModal" class="site-btn mb-2">Nuevo Catálogo</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">Marca</th>
                <th class="text-left">Título</th>
                <th class="text-left">Archivo PDF</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $catalogos = new Catalogos();
                $results = $catalogos->getCatalogos();

                if ( $results && $results->num_rows > 0 ) :
                    while ( $cat = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-catalogo.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="5"><h3>No existen catálogos cargados</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>
