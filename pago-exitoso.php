<?php require_once('inc/layout/head.php'); ?>

<!-- Header Section Begin -->
<?php require_once('inc/layout/header.php'); ?>

<?php
// require __DIR__."/inc/functions/class-pagos.php";
// require __DIR__."/inc/functions/class-pedidos.php";
// require __DIR__."/inc/functions/class-usuarios.php";
// require __DIR__."/inc/functions/class-detalles.php";
?>

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2>PAGO EXITOSO,<br>Nos comunicaremos con usted en breve.</h2>
                <br>
                <?php
                    $payment_id = $_GET["payment_id"] ?? null;

                    if ($payment_id) {

                        $url = "https://api.mercadopago.com/v1/payments/".$payment_id;

                        $opts = [
                            "http" => [
                                "header" => "Authorization: Bearer ".getenv("MP_ACCESS_TOKEN_TEST")
                            ]
                        ];

                        $res = file_get_contents($url, false, stream_context_create($opts));
                        $pago = json_decode($res, true);

                        if ($pago && $pago["status"] === "approved") {
                            echo "<h1>Gracias por tu compra 🎉</h1>";
                            echo "Pago ID: ".$payment_id."<br>";
                            echo "Método: ".$pago["payment_method"]["type"]."<br>";
                            echo "Monto: ".$pago["transaction_amount"]."<br>";

                            $id_pedido = (isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null);

                            if (!isset($_SESSION["Id_Cliente"]) || $_SESSION["Id_Cliente"] == 0) die('false');

                            if ($id_pedido && $_SESSION["Id_Cliente"]) {
                                
                                $order = new Pedidos($id_pedido);
                                $user = new Usuarios($_SESSION["Id_Cliente"]);
                                $order->Nombre = $user->getNombre();
                                $order->Mail  = $user->getMail();
                                $order->Telefono  = '';
                                $order->Localidad  = $user->getLocalidad();
    
                                // $order->SubTotal = $data->subtotal;
                                // $order->PctDescuento = $data->PctDescuento;
                                // $order->Descuento = $data->descuento;
                                $order->ImpTotal = $pago["transaction_amount"];
                                $order->Id_Cliente = $_SESSION["Id_Cliente"];
                                $order->FechaFin = date("Y-m-d");
                                $order->Cerrado = 1;
                                $order->finalizarPedido();
    
                                // Update stock
                                $detail = new Detalles();
                                $pedido = $detail->getDetallesPedido($id_pedido);
                                $detail->updateStock($pedido);
    
                                // Send mail to client
                                $datos = new Polirubro();
                                $body = $datos->getBodyEmail($id_pedido);
                                $datos->sendMail($id_pedido, $order->Mail, $body);
                            }
                            

                        } else {
                            echo "<h1>Pago pendiente / no confirmado</h1>";
                        }

                    } else {
                        echo "Pago no válido.";
                    }
                ?>
                <a href="index.php" class="site-btn">CONTINUAR</a>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section Begin -->
<?php require_once('inc/layout/footer.php'); ?>
<!-- Footer Section End -->