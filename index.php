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

<!-- Slider Begin -->
<?php if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php' || $_SERVER['REQUEST_URI'] === '/nuevo/' || $_SERVER['REQUEST_URI'] === '/nuevo/index.php') :
    require_once('inc/parts/slider.php'); 
endif; ?>
<!-- Slider End -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 px-0 text-center">
            <h2>PRÓXIMAMENTE ESTAREMOS RECIBIENDO PEDIDOS</h2>
            <p>Estamos trabajando para darte la mejor experiencia de compra!</p>
        </div>
    </div>
</div>

<!-- Banner Shopping Begin -->
<?php require_once('inc/parts/banner-shopping.php'); ?>
<!-- Banner End -->

<!-- Banner Begin -->
<?php //require_once('inc/parts/banner-section.php'); ?>
<!-- Banner End -->

<!-- Categories Section Begin -->
<?php //require_once('inc/parts/categories-section.php'); ?>
<!-- Categories Section End -->

<!-- Categories Section Begin -->
<?php require_once('inc/parts/left-right-mipupu.php'); ?>
<!-- Categories Section End -->

<!-- Banner Shopping Begin -->
<?php require_once('inc/parts/banner-tiktokers.php'); ?>
<!-- Banner End -->

<!-- Categories Section Begin -->
<?php require_once('inc/parts/left-right-tiktokers.php'); ?>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<?php //require_once('inc/parts/featured-products-section.php'); ?>
<!-- Featured Section End -->

<!-- New Products Section Begin -->
<?php require_once('inc/parts/new-products-section.php'); ?>
<!-- New Products Section End -->

<!-- Latest Product Section Begin -->
<?php //require_once('inc/parts/last-products-section.php'); ?>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<?php //require_once('inc/parts/blog-section.php'); ?>
<!-- Blog Section End -->

<!-- Instagram Section Begin -->
<?php if ($general->show_instagram) : ?>
<?php require_once('inc/parts/instagram-section.php'); ?>
<?php endif; ?>
<!-- Instagram Section End -->

<!-- Modal Promo -->
<?php require_once('inc/parts/promo-modal.php'); ?>
<!-- Modal Promo End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->