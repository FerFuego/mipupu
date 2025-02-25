<section class="featured spad">
    <?php   
        $products = new Productos();
        $results = $products->getProductsOffertNews();
        
        if ( $results->num_rows > 0 ) : ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Indumentaria para todas las edades</h2>
                        <p>Sumate a la onda TikTokers</p>
                    </div>
                </div>
            </div>
            <div class="row featured__filter owl-carousel">
                <?php while ( $product = $results->fetch_object() ) : ?>
                    <?php require 'inc/partials/product-card.php'; ?>
                <?php endwhile; ?>
            </div>
        </div>

    <?php endif; ?>
    
</section>