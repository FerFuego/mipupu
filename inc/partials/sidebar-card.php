<div class="latest-prdouct__slider__item">
    <a href="detalle.php?id=<?php echo $product->Id_Producto; ?>" class="latest-product__item">
        <div class="latest-product__item__text">
            <img src="<?php echo Productos::getImage( $product->CodProducto, $product->Id_Producto ); ?>" alt="<?php echo $product->CodProducto; ?>">
            <h6><?php echo $product->Nombre; ?></h6>
            <span><?php echo $product->CodProducto; ?></span>
        </div>
    </a>
</div>