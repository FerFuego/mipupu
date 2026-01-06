<div class="shoping__cart__table">
    <div class="d-flex justify-content-between mb-2">
        <div></div>
        <!-- <button data-toggle="modal" onclick="cleanModal();" data-target="#clientModal" class="site-btn mb-2">Nuevo Producto</button> -->
        <?php require 'inc/partials/cpanel/search-product.php'; ?>
    </div>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th class="text-left">Imagen</th>
                <th class="text-left">Codigo</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Clasificacion</th>
                <th class="text-left">Marca</th>
                <th class="text-left">Rubro</th>
                <th class="text-left">SubRubro</th>
                <th class="text-left">Grupo</th>
                <th class="text-left">Novedad</th>
                <th class="text-left">Oferta</th>
                <th class="text-left">Stock</th>
                <th class="text-left">Observaciones</th>
                <th class="text-left">Editar</th>
                <th class="text-left">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($search != '') {
                $productos = new Productos();
                $result = $productos->getProductSearch($opcion, $search);
            } else {
                $id_rubro = (isset($_GET['id_rubro']) && $_GET['id_rubro'] != '') ? $_GET['id_rubro'] : null;
                $id_subrubro = (isset($_GET['id_subrubro']) && $_GET['id_subrubro'] != '') ? $_GET['id_subrubro'] : null;
                $id_grupo = (isset($_GET['id_grupo']) && $_GET['id_grupo'] != '') ? $_GET['id_grupo'] : null;
                $id_marca = (isset($_GET['id_marca']) && $_GET['id_marca'] != '') ? $_GET['id_marca'] : null;
                $id_clasificacion = (isset($_GET['id_clasificacion']) && $_GET['id_clasificacion'] != '') ? $_GET['id_clasificacion'] : null;
                $minamount = (isset($_GET['minamount']) && $_GET['minamount'] != '') ? $_GET['minamount'] : null;
                $maxamount = (isset($_GET['maxamount']) && $_GET['maxamount'] != '') ? $_GET['maxamount'] : null;
                $order = (isset($_GET['order']) && $_GET['order'] != '') ? $_GET['order'] : null;
                $productos = new Productos();
                $result = $productos->getProducts($opcion, $id_rubro, $id_subrubro, $id_grupo, $minamount, $maxamount, $order, $id_marca, $id_clasificacion);
            }

            $paginator = new Paginator($result['query'], $result['total']);
            $results = $paginator->getData($limit, $page);

            if ($results->num_rows > 0):
                while ($product = $results->fetch_object()):
                    require 'inc/partials/cpanel/item-product.php';
                endwhile;
            else: ?>
                <tr>
                    <td colspan="6">
                        <h3>No existen productos</h3>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $paginator->createLinks($links, $result['params'], 'product__pagination'); ?>
</div>