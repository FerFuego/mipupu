<section class="related-product">
<?php   
    $products = new Productos();
    $results = $related->getRelatedProducts($product->getRubroID(), $product->getSubRubroID(), $product->getGrupoID(), $product->getID());
    
    if ( $results->num_rows > 0 ) : ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Productos Relacionados</h2>
                    </div>
                </div>
            </div>
            <div class="row owl-carousel">
                <?php while ( $product = $results->fetch_object() ) : ?>
                    <?php require 'inc/partials/product-card.php'; ?>
                <?php endwhile; ?>
            </div>
        </div>
        
    <?php endif; ?>
</section>