<?php require_once('inc/layout/head.php'); ?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>
<!-- Header Section End -->

<!-- Breadcrumb Section Begin -->
<?php require_once('inc/parts/breadcrumb-section.php'); ?>
<!-- Breadcrumb Section End -->

<?php
// Auto-login data
$clienteNombre = '';
$clienteEmail = '';
$clienteTelefono = '';

if (isset($_SESSION["Id_Cliente"]) && $_SESSION["Id_Cliente"] > 0) {
    $u = new Usuarios($_SESSION["Id_Cliente"]);
    $clienteNombre = $u->Nombre ?? '';
    $clienteEmail = $u->Mail ?? '';
    // Asumiendo que el telefono no está en la base de usuario directo o se saca de pedidos, lo dejamos vacío si no existe propiedad
    $clienteTelefono = $u->Telefono ?? '';
}
?>

<!-- Preventa Section Begin -->
<section class="preventa-page spad">
    <div class="container">

        <!-- Catálogos Section -->
        <div class="row mb-5">
            <div class="col-lg-12 text-center mb-4">
                <div class="section-title">
                    <h2>Descarga Nuestros Catálogos</h2>
                    <p class="mt-5">Explora los últimos modelos y productos de nuestras marcas exclusivas.</p>
                </div>
            </div>

            <?php
            $catalogosCls = new Catalogos();
            $catalogos = $catalogosCls->getCatalogos();
            if ($catalogos && $catalogos->num_rows > 0):
                while ($c = $catalogos->fetch_object()):
                    ?>
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow-sm border-0 d-flex flex-column flex-md-row align-items-center"
                            style="border-radius: 12px; overflow: hidden; padding: 20px;">
                            
                            <!-- Imagen Tapa -->
                            <div style="width: 100%; max-width: 200px; height: 200px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 15px;" class="mb-md-0 mr-md-4">
                                <?php if($c->Imagen): ?>
                                    <img src="fotos/catalogos/<?php echo $c->Imagen; ?>" alt="Tapa Catálogo" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fa fa-file-pdf-o text-danger" style="font-size: 64px;"></i>
                                <?php endif; ?>
                            </div>

                            <!-- Contenido -->
                            <div class="flex-grow-1 text-center text-md-left mb-3 mb-md-0">
                                <h3 class="font-weight-bold mb-2 text-dark" style="font-family: 'Cairo', sans-serif;"><?php echo $c->Marca_Nombre; ?></h3>
                                <h6 class="text-secondary mb-3" style="font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; color: #e61b52 !important;"><?php echo $c->Titulo; ?></h6>
                                <p class="text-muted mb-0" style="font-size: 15px; max-width: 800px;"><?php echo nl2br($c->Texto); ?></p>
                            </div>

                            <!-- Boton -->
                            <div class="ml-md-auto text-center" style="min-width: 200px;">
                                <a href="fotos/catalogos/<?php echo $c->Archivo_PDF; ?>" target="_blank" class="site-btn w-100"
                                    style="padding: 12px 25px; font-size: 16px; border-radius: 30px;">
                                    <i class="fa fa-download mb-1 mr-1"></i> DESCARGAR
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
            else:
                ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info">Aún no hay catálogos disponibles para descargar.</div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Preventa Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="checkout__form shadow p-5" style="border-radius: 15px; background: #fff;">
                    <div class="section-title text-center mb-4">
                        <h2>Encargar Productos (Preventa)</h2>
                        <p class="mt-5">Completa el formulario para realizar tu pedido de preventa. Nos contactaremos
                            para coordinar.
                        </p>
                    </div>

                    <form id="js-form-preventa" action="#" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__input">
                                    <p>Nombre Completo<span>*</span></p>
                                    <input type="text" name="nombre" required
                                        value="<?php echo htmlspecialchars($clienteNombre ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="email" required
                                        value="<?php echo htmlspecialchars($clienteEmail ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__input">
                                    <p>Teléfono / WhatsApp<span>*</span></p>
                                    <input type="text" name="telefono" required placeholder="Ej: +54 9 11 1234-5678"
                                        value="<?php echo htmlspecialchars($clienteTelefono ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout__input">
                                    <p>Marca a Encargar<span>*</span></p>
                                    <select name="id_marca" class="form-control"
                                        style="height: 46px; border: 1px solid #ebebeb; border-radius: 4px; padding-left: 20px; font-size: 16px; color: #444444;"
                                        required>
                                        <option value="">Seleccione una Marca</option>
                                        <?php
                                        // Traemos las marcas para que seleccionen de cual quieren encargar
                                        $mCls = new Marcas();
                                        $resultsM = $mCls->getMarcas();
                                        while ($m = $resultsM->fetch_object()):
                                            ?>
                                            <option value="<?php echo $m->Id_Marca; ?>"><?php echo $m->Nombre; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input mt-3">
                            <p>Imagen con tu pedido (Opcional)<span></span></p>
                            <input type="file" name="archivo_imagen" class="form-control"
                                style="border: none; padding-left: 0; background: transparent;"
                                accept="image/png, image/jpeg, image/webp, image/gif">
                            <small class="text-muted">Sube una foto u hoja escrita con el detalle de lo que quieres
                                encargar.</small>
                        </div>

                        <div class="checkout__input mt-3">
                            <p>Mensaje / Detalle del Pedido<span>*</span></p>
                            <textarea name="mensaje" required
                                placeholder="Escriba aquí los códigos/artículos que desea encargar"
                                style="width: 100%; height: 120px; border: 1px solid #ebebeb; border-radius: 4px; padding: 15px; font-size: 16px; color: #444444;"></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="site-btn" id="btn-submit-preventa"
                                onclick="submitPreventa();">HACER EL ENCARGO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Preventa Section End -->

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->

<script>
    function submitPreventa() {
        // Basic validation
        var form = $('#js-form-preventa')[0];
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        var formData = new FormData(form);
        formData.append('action', 'submit_preventa');

        var btn = $('#btn-submit-preventa');
        var oldText = btn.text();
        btn.text('ENVIANDO...').prop('disabled', true);

        $.ajax({
            url: 'inc/functions/ajax-requests.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                btn.text(oldText).prop('disabled', false);
                try {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        // Si existe SweetAlert lo usamos
                        if (typeof swal !== 'undefined') {
                            swal("¡Excelente!", "Tu encargo ha sido enviado correctamente. Nos pondremos en contacto.", "success").then(() => {
                                window.location.reload();
                            });
                        } else {
                            alert("¡Excelente! Tu encargo ha sido enviado correctamente. Nos pondremos en contacto.");
                            window.location.reload();
                        }
                    } else {
                        alert("Error: " + res.message);
                    }
                } catch (e) {
                    alert("Error de servidor. Intente nuevamente.");
                }
            },
            error: function () {
                btn.text(oldText).prop('disabled', false);
                alert("Error de conexión. Intente nuevamente.");
            }
        });
    }
</script>