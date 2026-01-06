<?php
$id_rubro = (isset($_GET['id_rubro']) && $_GET['id_rubro'] != '') ? $_GET['id_rubro'] : null;
$id_subrubro = (isset($_GET['id_subrubro']) && $_GET['id_subrubro'] != '') ? $_GET['id_subrubro'] : null;
$id_grupo = (isset($_GET['id_grupo']) && $_GET['id_grupo'] != '') ? $_GET['id_grupo'] : null;
$minamount = (isset($_GET['minamount']) && $_GET['minamount'] != '') ? $_GET['minamount'] : null;
$maxamount = (isset($_GET['maxamount']) && $_GET['maxamount'] != '') ? $_GET['maxamount'] : null;
$order = (isset($_GET['order']) && $_GET['order'] != '') ? $_GET['order'] : null;
$id_marca = (isset($_GET['id_marca']) && $_GET['id_marca'] != '') ? $_GET['id_marca'] : null;
$id_clasificacion = (isset($_GET['id_clasificacion']) && $_GET['id_clasificacion'] != '') ? $_GET['id_clasificacion'] : null;
$search = (isset($_GET['s']) && $_GET['s'] != '') ? $_GET['s'] : null;
?>

<div class="sidebar">
    <div class="sidebar__item">
        <h4>Precio</h4>
        <div class="price-range-wrap">
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" data-max="100000">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
            <div class="range-slider">
                <form action="productos.php" method="GET">
                    <input type="hidden" name="id_subrubro" value="<?php echo $id_subrubro; ?>">
                    <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
                    <input type="hidden" name="order" value="<?php echo $order; ?>">
                    <input type="hidden" name="s" value="<?php echo $search; ?>">
                    <?php
                    if (is_array($id_rubro))
                        foreach ($id_rubro as $v)
                            echo '<input type="hidden" name="id_rubro[]" value="' . $v . '">';
                    if (is_array($id_marca))
                        foreach ($id_marca as $v)
                            echo '<input type="hidden" name="id_marca[]" value="' . $v . '">';
                    if (is_array($id_clasificacion))
                        foreach ($id_clasificacion as $v)
                            echo '<input type="hidden" name="id_clasificacion[]" value="' . $v . '">';
                    ?>
                    <div class="price-input">
                        <input type="text" name="minamount" id="minamount" value="<?php echo $minamount; ?>">
                        <input type="text" name="maxamount" id="maxamount" value="<?php echo $maxamount; ?>">
                    </div>
                </form>

                <?php if (isset($minamount) || isset($maxamount)): ?>
                    <p class="mt-3 mb-0 text-success">Filtrado de $<?php echo $minamount; ?> a
                        $<?php echo $maxamount; ?>.-
                    </p>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="sidebar__item d-none d-sm-block">
        <h4>Marcas</h4>
        <ul>
            <?php
            $marcas = new Marcas();
            $result_m = $marcas->getMarcas();

            while ($m = $result_m->fetch_object()):
                $is_active_m = false;
                if (is_array($id_marca)) {
                    if (in_array($m->Id_Marca, $id_marca))
                        $is_active_m = true;
                } else {
                    if ($id_marca == $m->Id_Marca)
                        $is_active_m = true;
                }
                ?>
                <li>
                    <a href="<?php echo Polirubro::buildFilterUrl('id_marca', $m->Id_Marca); ?>"
                        class="item <?php echo $is_active_m ? 'active' : ''; ?>">
                        <input type="checkbox" <?php echo $is_active_m ? 'checked' : ''; ?> onclick="window.location.href='
                    <?php echo Polirubro::buildFilterUrl('id_marca', $m->Id_Marca); ?>'; event.stopPropagation();">
                        <?php echo $m->Nombre; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="sidebar__item d-none d-sm-block">
        <h4>Tipos</h4>
        <ul>
            <?php
            $clasificaciones = new Clasificaciones();
            $result_c = $clasificaciones->getClasificaciones();

            while ($c = $result_c->fetch_object()):
                $is_active_c = false;
                if (is_array($id_clasificacion)) {
                    if (in_array($c->Id_Clasificacion, $id_clasificacion))
                        $is_active_c = true;
                } else {
                    if ($id_clasificacion == $c->Id_Clasificacion)
                        $is_active_c = true;
                }
                ?>
                <li>
                    <a href="<?php echo Polirubro::buildFilterUrl('id_clasificacion', $c->Id_Clasificacion); ?>"
                        class="item <?php echo $is_active_c ? 'active' : ''; ?>">
                        <input type="checkbox" <?php echo $is_active_c ? 'checked' : ''; ?>
                            onclick="window.location.href='<?php echo Polirubro::buildFilterUrl('id_clasificacion', $c->Id_Clasificacion); ?>'; event.stopPropagation();">
                        <?php echo $c->Nombre; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <div class="sidebar__item d-none d-sm-block">
        <h4>Categorías</h4>
        <ul>
            <?php
            $rubros = new Rubros();
            $result = $rubros->getRubros();

            while ($rubro = $result->fetch_object()):
                $is_active = false;
                if (is_array($id_rubro)) {
                    if (in_array($rubro->Id_Rubro, $id_rubro))
                        $is_active = true;
                } else {
                    if ($id_rubro == $rubro->Id_Rubro)
                        $is_active = true;
                } ?>
                <li>
                    <a href="<?php echo Polirubro::buildFilterUrl('id_rubro', $rubro->Id_Rubro); ?>"
                        class="item <?php echo $is_active ? 'active' : ''; ?>">
                        <input type="checkbox" <?php echo $is_active ? 'checked' : ''; ?>
                            onclick="window.location.href='<?php echo Polirubro::buildFilterUrl('id_rubro', $rubro->Id_Rubro); ?>'; event.stopPropagation();">
                        <?php echo $rubro->Nombre; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <?php
    $news = new Productos();
    $results = $news->getProductNews(10);

    if ($results->num_rows > 0): ?>

        <div class="sidebar__item d-none d-sm-block">
            <div class="latest-product__text">
                <h4>Últimos Productos</h4>
                <div class="latest-product__slider owl-carousel">
                    <?php
                    while ($product = $results->fetch_object()):
                        require 'inc/partials/sidebar-card.php';
                    endwhile;
                    ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>