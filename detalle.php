<?php require_once('inc/layout/head.php'); ?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<!-- <section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <?php //require_once('inc/parts/categories.php'); 
            ?>
            <?php //require_once('inc/parts/search.php'); 
            ?>
        </div>
    </div>
</section> -->
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<?php require_once('inc/parts/breadcrumb-section.php'); ?>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<?php if ($id) :

    $product = new Productos($id);

    if ($product->getNombre()) : ?>

        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large" src="<?php echo Productos::getImage($product->getCode()); ?>" alt="">
                            </div>
                            <!--  <div class="product__details__pic__slider owl-carousel">
                                <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                    src="img/product/details/thumb-1.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                    src="img/product/details/thumb-2.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                    src="img/product/details/thumb-3.jpg" alt="">
                                <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                    src="img/product/details/thumb-4.jpg" alt="">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3><?php echo $product->getNombre(); ?></h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <!-- <i class="fa fa-star-half-o"></i> -->
                                <!-- <span>(18 reviews)</span> -->
                            </div>

                            <h4>Cód.: <?php echo $product->getCode(); ?></h4>
                            <?php if ($general->showPrices()): ?>
                                <form class="js-form-cart">
                                    <div class="product__details__price">$<?php echo number_format($product->PreVtaFinal1(), 2, ',', '.'); ?></div>
                                    <input type="hidden" name="id_product" value="<?php echo $product->getID(); ?>">
                                    <input type="hidden" name="cod_product" value="<?php echo $product->getCode(); ?>">
                                    <input type="hidden" name="name_product" value="<?php echo $product->getNombre(); ?>">
                                    <input type="hidden" name="price_product" value="<?php echo $product->PreVtaFinal1(); ?>">

                                    <!-- <div>
                                        <textarea type="text" name="nota" class="product__details__note" placeholder="Agregar Nota"></textarea>
                                    </div> -->

                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" name="cant" min="1" max="99999" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" class="primary-btn" value="AGREGAR AL CARRITO">
                                    <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                                </form>
                            <?php endif; ?>

                            <div class="js-login-message"></div>

                            <ul>
                                <?php if ($product->marca) : ?>
                                    <li><b>Marca</b> <span><?php echo ucfirst(strtolower($product->marca)); ?></span></li>
                                <?php endif; ?>

                                <?php if ($product->rubro) : ?>
                                    <li><b>Rubro</b> <span><?php echo ucfirst(strtolower($product->rubro)); ?></span></li>
                                <?php endif; ?>

                                <?php if ($product->subrubro) : ?>
                                    <li><b>SubRubro</b> <span><?php echo ucfirst(strtolower($product->subrubro)); ?></span></li>
                                <?php endif; ?>

                                <?php if ($product->grupo) : ?>
                                    <li><b>Grupo</b> <span><?php echo ucfirst(strtolower($product->grupo)); ?></span></li>
                                <?php endif; ?>

                                <li><b>Disponibilidad</b> <span>Hay Stock</span></li>

                                <?php if ($product->observaciones) : ?>
                                    <li><b>Observaciones</b> <span><?php echo ucfirst(strtolower($product->observaciones)); ?></span></li>
                                <?php endif; ?>
                                <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                                <li><b>Weight</b> <span>0.5 kg</span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">CAMBIOS Y DEVOLUCIONES</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">MÉTODO DE ENVÍO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                        aria-selected="false">MÉTODO DE PAGO</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <p><strong>Cambios:</strong><br>
                                            Tenés 15 días corridos desde que retiraste o recibiste la compra para contactarte con nosotros y solicitarlo.
                                            Los mismos, dejan de contar una vez nos envíes el primer mail.<br>
                                            Dispones de dos tipos de cambio:
                                            - Cambio en local.<br>
                                            - Cambio online
                                            <br><br>
                                            <strong>Devoluciones:</strong><br>
                                            Tenés 10 días corridos desde que retiraste o recibiste la compra para hacer la devolución.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <p><strong>Retiro gratis en local:</strong><br>
                                            Disponibilidad inmediata. Podés retirar en Pio Angulo 470, Bell Ville, Córdoba, Argentina.<br>
                                            <a href="/contacto.php" target="_blank">Ver ubicación del local</a><br>
                                            <strong>Envío a domicilio en Bell Ville:</strong><br>
                                            - Si pedís días hábiles antes de las 11:00 horas lo recibís el mismo día.<br>
                                            - Si pedís en fin de semana o feriado, te llega al siguiente día hábil.<br>
                                            - Costo de envío: $1.500.<br>
                                            - Entrega estimada: 1 a 2 días hábiles.<br>
                                        <strong>Envío con Correo Argentino:</strong><br>
                                            - Costo de envío: pago en destino.<br>
                                            - Entrega estimada: 3 a 5 días hábiles.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Método de pago</h6>

                                        <p></p>
                                        <div class="mp-payment-methods-container">
                                            <div class="mp-payment-method-type-container">
                                                <div class="mp-payment-methods-header">
                                                    <p class="mp-payment-methods-title">Tarjetas de crédito</p>
                                                    <div class="mp-payment-methods-badge">
                                                        <span class="mp-payment-methods-badge-text">hasta 3 cuotas sin interés</span>
                                                    </div>
                                                </div>
                                                <div class="mp-payment-methods-content">
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/e8ffdc40-5dc7-11ec-ae75-df2bef173be2-xl@2x.png" alt="cencosud">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cencosud" src="https://http2.mlstatic.com/storage/logos-api-admin/e8ffdc40-5dc7-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cencosud" src="https://http2.mlstatic.com/storage/logos-api-admin/e8ffdc40-5dc7-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/33ea00e0-571a-11e8-8364-bff51f08d440-xl@2x.png" alt="tarshop">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="tarshop" src="https://http2.mlstatic.com/storage/logos-api-admin/33ea00e0-571a-11e8-8364-bff51f08d440-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="tarshop" src="https://http2.mlstatic.com/storage/logos-api-admin/33ea00e0-571a-11e8-8364-bff51f08d440-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/d7e55980-f3be-11eb-8e0d-6f4af49bf82e-xl@2x.png" alt="argencard">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="argencard" src="https://http2.mlstatic.com/storage/logos-api-admin/d7e55980-f3be-11eb-8e0d-6f4af49bf82e-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="argencard" src="https://http2.mlstatic.com/storage/logos-api-admin/d7e55980-f3be-11eb-8e0d-6f4af49bf82e-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/0fada860-571c-11e8-8364-bff51f08d440-xl@2x.png" alt="cordobesa">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cordobesa" src="https://http2.mlstatic.com/storage/logos-api-admin/0fada860-571c-11e8-8364-bff51f08d440-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cordobesa" src="https://http2.mlstatic.com/storage/logos-api-admin/0fada860-571c-11e8-8364-bff51f08d440-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png" alt="visa">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="visa" src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="visa" src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png" alt="cabal">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cabal" src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cabal" src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/b08cf800-4c1a-11e9-9888-a566cbf302df-xl@2x.png" alt="amex">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="amex" src="https://http2.mlstatic.com/storage/logos-api-admin/b08cf800-4c1a-11e9-9888-a566cbf302df-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="amex" src="https://http2.mlstatic.com/storage/logos-api-admin/b08cf800-4c1a-11e9-9888-a566cbf302df-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/770edaa0-5dc7-11ec-a13d-73e40a9e9500-xl@2x.png" alt="naranja">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="naranja" src="https://http2.mlstatic.com/storage/logos-api-admin/770edaa0-5dc7-11ec-a13d-73e40a9e9500-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="naranja" src="https://http2.mlstatic.com/storage/logos-api-admin/770edaa0-5dc7-11ec-a13d-73e40a9e9500-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/751ea930-571a-11e8-9a2d-4b2bd7b1bf77-xl@2x.png" alt="diners">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="diners" src="https://http2.mlstatic.com/storage/logos-api-admin/751ea930-571a-11e8-9a2d-4b2bd7b1bf77-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="diners" src="https://http2.mlstatic.com/storage/logos-api-admin/751ea930-571a-11e8-9a2d-4b2bd7b1bf77-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/26fbb110-571c-11e8-95d8-631c1a9a92a9-xl@2x.png" alt="cmr">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cmr" src="https://http2.mlstatic.com/storage/logos-api-admin/26fbb110-571c-11e8-95d8-631c1a9a92a9-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="cmr" src="https://http2.mlstatic.com/storage/logos-api-admin/26fbb110-571c-11e8-95d8-631c1a9a92a9-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png" alt="master">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="master" src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="master" src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                </div>
                                            </div>
                                            <div class="mp-payment-method-type-container">
                                                <div class="mp-payment-methods-header">
                                                    <p class="mp-payment-methods-title">Tarjetas de débito </p>
                                                    <div class="mp-payment-methods-badge"><span class="mp-payment-methods-badge-text">hasta 4 cuotas sin interés</span>
                                                    </div>
                                                </div>
                                                <div class="mp-payment-methods-content">
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/ce454480-445f-11eb-bf78-3b1ee7bf744c-xl@2x.png" alt="maestro">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="maestro" src="https://http2.mlstatic.com/storage/logos-api-admin/ce454480-445f-11eb-bf78-3b1ee7bf744c-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="maestro" src="https://http2.mlstatic.com/storage/logos-api-admin/ce454480-445f-11eb-bf78-3b1ee7bf744c-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png" alt="debmaster">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debmaster" src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debmaster" src="https://http2.mlstatic.com/storage/logos-api-admin/0daa1670-5c81-11ec-ae75-df2bef173be2-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png" alt="debcabal">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debcabal" src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debcabal" src="https://http2.mlstatic.com/storage/logos-api-admin/c9f71470-6f07-11ec-9b23-071a218bbe35-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png" alt="debvisa">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debvisa" src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="debvisa" src="https://http2.mlstatic.com/storage/logos-api-admin/d589be70-eb86-11e9-b9a8-097ac027487d-xl@2x.png"></div>
                                                    </payment-method-logo>
                                                </div>
                                            </div>
                                            <div class="mp-payment-method-type-container">
                                                <div class="mp-payment-methods-header">
                                                    <p class="mp-payment-methods-title">Pagos en efectivo </p>
                                                </div>
                                                <div class="mp-payment-methods-content">
                                                    <payment-method-logo src="https://www.mercadopago.com/org-img/MP3/API/logos/pagofacil.gif" alt="pagofacil">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="pagofacil" src="https://www.mercadopago.com/org-img/MP3/API/logos/pagofacil.gif"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="pagofacil" src="https://www.mercadopago.com/org-img/MP3/API/logos/pagofacil.gif"></div>
                                                    </payment-method-logo>
                                                    <payment-method-logo src="https://www.mercadopago.com/org-img/MP3/API/logos/rapipago.gif" alt="rapipago">
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="rapipago" src="https://www.mercadopago.com/org-img/MP3/API/logos/rapipago.gif"></div>
                                                        <div class="mp-payment-method-logo-container"><img class="mp-payment-method-logo-image" alt="rapipago" src="https://www.mercadopago.com/org-img/MP3/API/logos/rapipago.gif"></div>
                                                    </payment-method-logo>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php else : ?>

        <section class="product-details container spad">
            <h2>Producto no encontrado</h2>
        </section>

    <?php endif; ?>

<?php else : ?>

    <section class="product-details container spad">
        <h2>Producto no encontrado</h2>
    </section>

<?php endif; ?>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<?php require_once('inc/parts/related-products.php'); ?>
<!-- Related Product Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->