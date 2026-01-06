<?php require_once('inc/layout/head.php'); ?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<!-- <section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <?php //require_once('inc/parts/categories.php'); ?>
            <?php //require_once('inc/parts/search.php'); ?>
        </div>
    </div>
</section> -->
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<?php require_once('inc/parts/breadcrumb-section.php'); ?>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <!-- Breadcrumb Section Begin -->
                <?php require_once('inc/parts/sidebar.php'); ?>
                <!-- Breadcrumb Section End -->
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="col-lg-12">
                    <?php if (
                        (isset($_GET['id_rubro']) && $_GET['id_rubro'] != '') ||
                        (isset($_GET['id_subrubro']) && $_GET['id_subrubro'] != '') ||
                        (isset($_GET['id_subrubro']) && $_GET['id_grupo'] != '')
                    ): ?>
                        <h4>Filtrado por:
                            <span class="mt-3 mb-0 text-success" style="font-size: 18px;">

                                <?php if (isset($_GET['id_rubro']) && $_GET['id_rubro'] != ''):
                                    $rubros = $_GET['id_rubro'];
                                    if (is_array($rubros)) {
                                        foreach ($rubros as $key => $value) {
                                            $rubro = new Rubros($value);
                                            echo '<span class="text-success">' . $rubro->nombre . '</span> / ';
                                        }
                                    } else {
                                        $rubro = new Rubros($_GET['id_rubro']);
                                        echo '<a href="productos.php?id_rubro=' . $rubro->id_rubro . '" class="text-success">' . $rubro->nombre . '</a>';
                                    }
                                endif; ?>

                                <?php if (isset($_GET['id_subrubro']) && $_GET['id_subrubro'] != ''):
                                    $subrubro = new Subrubros($_GET['id_subrubro']); ?>
                                    / <a href="productos.php?id_rubro=<?php echo $rubro->id_rubro; ?>&id_subrubro=<?php echo $subrubro->id_subrubro; ?>"
                                        class="text-success"><?php echo $subrubro->nombre; ?></a>
                                <?php endif; ?>

                                <?php if (isset($_GET['id_grupo']) && $_GET['id_grupo'] != ''):
                                    $grupo = new Grupos($_GET['id_grupo']); ?>
                                    <?php echo ' / ' . $grupo->nombre; ?>
                                <?php endif; ?>

                                <?php if (isset($_GET['id_clasificacion']) && $_GET['id_clasificacion'] != ''):
                                    $clasifs = $_GET['id_clasificacion'];
                                    if (is_array($clasifs)) {
                                        foreach ($clasifs as $value) {
                                            $clasif_f = new Clasificaciones($value);
                                            echo ' / ' . $clasif_f->nombre;
                                        }
                                    } else {
                                        $clasif_f = new Clasificaciones($_GET['id_clasificacion']);
                                        echo ' / ' . $clasif_f->nombre;
                                    }
                                endif; ?>

                                <?php if (isset($_GET['id_marca']) && $_GET['id_marca'] != ''):
                                    $marcas_f = $_GET['id_marca'];
                                    if (is_array($marcas_f)) {
                                        foreach ($marcas_f as $value) {
                                            $marca_f = new Marcas($value);
                                            echo ' / ' . $marca_f->nombre;
                                        }
                                    } else {
                                        $marca_f = new Marcas($_GET['id_marca']);
                                        echo ' / ' . $marca_f->nombre;
                                    }
                                endif; ?>
                            </span>
                        </h4>
                    <?php endif; ?>
                </div>

                <?php
                if ($search != '') {
                    $productos = new Productos();
                    $result = $productos->getProductSearch(null, $search);
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
                    $result = $productos->getProducts(null, $id_rubro, $id_subrubro, $id_grupo, $minamount, $maxamount, $order, $id_marca, $id_clasificacion);
                }

                $paginator = new Paginator($result['query'], $result['total']);
                $results = $paginator->getData($limit, $page);
                ?>

                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 d-none d-sm-block">
                            <form id="form-order-prod" class="d-flex justify-content-around" method="GET">
                                <?php if (is_array($id_rubro)):
                                    foreach ($id_rubro as $key => $value) {
                                        echo '<input type="hidden" name="id_rubro[]" value="' . $value . '">';
                                    }
                                else:
                                    echo '<input type="hidden" name="id_rubro" value="' . $id_rubro . '">';
                                endif; ?>
                                <input type="hidden" name="id_subrubro" value="<?php echo $id_subrubro; ?>">
                                <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
                                <?php if (is_array($id_marca)):
                                    foreach ($id_marca as $value) {
                                        echo '<input type="hidden" name="id_marca[]" value="' . $value . '">';
                                    }
                                else:
                                    echo '<input type="hidden" name="id_marca" value="' . $id_marca . '">';
                                endif; ?>
                                <?php if (is_array($id_clasificacion)):
                                    foreach ($id_clasificacion as $value) {
                                        echo '<input type="hidden" name="id_clasificacion[]" value="' . $value . '">';
                                    }
                                else:
                                    echo '<input type="hidden" name="id_clasificacion" value="' . $id_clasificacion . '">';
                                endif; ?>
                                <input type="hidden" name="minamount" id="minamount-order"
                                    value="<?php echo $minamount; ?>">
                                <input type="hidden" name="maxamount" id="maxamount-order"
                                    value="<?php echo $maxamount; ?>">
                                <div class="filter__sort">
                                    <span>Ordenar Por</span>
                                    <select name="order" id="select-order-prod">
                                        <option value="0">Defecto</option>
                                        <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>Menor
                                            Precio
                                        </option>
                                        <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>Mayor
                                            Precio</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="filter__found mt-1">
                                <h6 class="text-right"><span><?php echo $result['total']; ?></span> Productos
                                    encontrados</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($results->num_rows) && $results->num_rows > 0): ?>

                    <div class="row">
                        <?php
                        while ($product = $results->fetch_object()):
                            require 'inc/partials/product.php';
                        endwhile;
                        ?>
                    </div>

                    <!-- Paginador -->
                    <?php echo $paginator->createLinks($links, $result['params'], 'product__pagination'); ?>
                    <!-- End Paginador -->

                <?php else: ?>
                    <h4>No se encontraron productos en esta categoría</h4>
                <?php endif; ?>

                <!-- Offer Section Begin -->
                <?php require_once('inc/parts/offert-section.php'); ?>
                <!-- Offer Section End -->

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->