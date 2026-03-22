<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <h4 class="mb-2">Encargos de Preventa</h4>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Fecha</th>
                <th class="text-left">Cliente</th>
                <th class="text-left">Marca</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $preventas = new Preventas();
                $results = $preventas->getPreventas();

                if ( $results && $results->num_rows > 0 ) :
                    while ( $prev = $results->fetch_object() ) :
                        require 'inc/partials/cpanel/item-preventa.php';
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="6"><h3>No existen encargos de preventa</h3></td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>
