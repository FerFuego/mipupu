<?php require_once('inc/layout/head.php'); ?>
<?php require_once('inc/layout/header.php'); ?>

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2>Procesando tu pago…</h2>
                <p>Gracias por tu compra. Estamos verificando tu pago.</p>
                <br>

                <?php

                $payment_id = $_GET["payment_id"] ?? null;
                $id_pedido = isset($_GET["id"]) ? (int)$_GET["id"] : null;

                if ($payment_id && $id_pedido) {

                    // Consultar API de MercadoPago
                    $url = "https://api.mercadopago.com/v1/payments/".$payment_id;
                    $opts = [
                        "http" => [
                            "header" => "Authorization: Bearer ".getenv("MP_ACCESS_TOKEN")
                        ]
                    ];

                    $res = file_get_contents($url, false, stream_context_create($opts));
                    $pago = json_decode($res, true);

                    if ($pago) {

                        $estado = $pago["status"];

                        echo "<b>Estado actual del pago:</b> ".$estado."<br>";
                        echo "<b>Pago ID:</b> ".$payment_id."<br>";
                        echo "<b>Método:</b> ".$pago["payment_method"]["type"]."<br>";
                        echo "<b>Monto:</b> ".$pago["transaction_amount"]."<br><br>";

                        require_once "inc/functions/class-pedidos.php";
                        require_once "inc/functions/class-detalles.php";
                        require_once "inc/functions/class-usuarios.php";

                        // Reservar pedido si aún no fue cerrado
                        $order = new Pedidos($id_pedido);

                        if ($order->Cerrado == 0) {

                            if (!isset($_SESSION["Id_Cliente"]) || $_SESSION["Id_Cliente"] == 0) {
                                echo "<h3>Error: el usuario no está logueado.</h3>";
                            } else {

                                // Datos del usuario
                                $user = new Usuarios($_SESSION["Id_Cliente"]);
                                $order->Nombre = $user->getNombre();
                                $order->Mail = $user->getMail();
                                $order->Localidad = $user->getLocalidad();

                                // Reserva del pedido
                                $order->ImpTotal = $pago["transaction_amount"];
                                $order->Id_Cliente = $_SESSION["Id_Cliente"];
                                $order->FechaFin = date("Y-m-d");
                                $order->Cerrado = 1; // Pedido reservado

                                $order->finalizarPedido();

                                // Descontar stock
                                $detail = new Detalles();
                                $pedidoDetalles = $detail->getDetallesPedido($id_pedido);
                                $detail->updateStock($pedidoDetalles);

                                echo "<h3>Hemos reservado tu pedido y tus productos.</h3>";
                            }
                        }

                        // Mensaje según estado
                        if ($estado === "approved") {
                            echo "<h3>Tu pago fue aprobado ✔</h3>";
                            echo "<p>Estamos completando tu pedido…</p>";
                        } else {
                            echo "<h3>Tu pago está pendiente de confirmación.</h3>";
                            echo "<p>Cuando se acredite, te enviaremos un email automáticamente.</p>";
                        }

                    } else {
                        echo "<h3>No pudimos obtener la información del pago.</h3>";
                    }

                } else {
                    echo "<h3>Pago no válido.</h3>";
                }

                ?>

                <a href="index.php" class="site-btn">Volver al inicio</a>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/layout/footer.php'); ?>
