<?php
file_put_contents(__DIR__."/webhook.log", date("Y-m-d H:i:s")." - Llego algo: ".file_get_contents("php://input")."\n\n", FILE_APPEND);


require __DIR__.'/config/mercadopago.php';
require __DIR__."/inc/functions/class-pedidos.php";
require __DIR__."/inc/functions/class-pagos.php";

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!empty($data["data"]["id"])) {

    $paymentId = $data["data"]["id"];

    $url = "https://api.mercadopago.com/v1/payments/".$paymentId;

    $opts = [
        "http" => [
            "header" => "Authorization: Bearer ". getenv('MP_ACCESS_TOKEN_TEST')
        ]
    ];

    $response = file_get_contents($url, false, stream_context_create($opts));
    $pago = json_decode($response, true);

    $estado = $pago["status"];
    $pedidoId = $pago["external_reference"];

    // instancia correcta
    $pagos = new Pagos();
    $pagos->registrarPago($pedidoId, $pago);
}

http_response_code(200);
exit;
