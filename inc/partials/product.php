<?php $prod = new Productos($product->CodProducto); ?>

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo Polirubro::get_slug($product->Rubro); ?>">
    <div class="product__item">
        <a href="detalle.php?id=<?php echo $product->CodProducto; ?>" class="product__item__pic set-bg"
            data-setbg="<?php echo Productos::getImage($product->CodProducto, $product->Id_Producto); ?>">
            <!-- <div class="product__discount__percent">-20%</div> -->
            <div class="product__code">
                <h5><?php echo 'COD: ' . $product->CodProducto; ?></h5>
            </div>
        </a>
        <div class="product__item__text">
            <span><?php echo $product->Rubro; ?></span>
            <h6><a href="detalle.php?id=<?php echo $product->CodProducto; ?>"><?php echo $product->Nombre; ?></a></h6>

            <?php if ($general->showPrices()): ?>
                <p class="text-danger">
                    <?php echo 'Precio Lista: <strong>$ ' . Polirubro::checkUserCapabilities($prod) . '</strong>'; ?>
                </p>
            <?php endif; ?>

            <?php if ($general->showLoginPrices()): ?>
                <form class="js-form-cart">
                    <input type="hidden" name="id_product" value="<?php echo $product->Id_Producto; ?>">
                    <input type="hidden" name="cod_product" value="<?php echo $product->CodProducto; ?>">
                    <input type="hidden" name="name_product" value="<?php echo $product->Nombre; ?>">
                    <input type="hidden" name="price_product"
                        value="<?php echo Polirubro::checkUserCapabilities($prod); ?>">
                    <div class="d-flex">
                        <textarea type="text" name="nota" class="product__details__note"
                            placeholder="Agregar Nota"><?php echo ($prod->getStock() > 0) ? '' : 'Sin Stock'; ?></textarea>
                    </div>

                    <div class="product__details__quantity mb-2">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="number" name="cant" min="1" max="<?php echo $prod->getStock(); ?>"
                                    value="<?php echo ($prod->getStock() > 0) ? 1 : 0; ?>">
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="primary-btn add-to-cart mb-2" value="+ CARRITO" <?php echo ($prod->getStock() > 0) ? '' : 'disabled'; ?>>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>