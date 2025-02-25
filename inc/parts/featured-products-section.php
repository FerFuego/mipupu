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
                <!-- <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev">
                        <span class="fa fa-angle-left">
                            <span></span>
                        </span>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                        <span class="fa fa-angle-right">
                            <span></span>
                        </span>
                    </button>
                </div> -->
            </div>
        </div>

    <?php endif; ?>
    
</section>