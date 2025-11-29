<?php

file_put_contents(__DIR__."/webhook.log", date("Y-m-d H:i:s")." - Llego algo: ".file_get_contents("php://input")."\n\n", FILE_APPEND);

require __DIR__.'/config/mercadopago.php';
require __DIR__."/inc/functions/class-pagos.php";
require __DIR__."/inc/functions/class-pedidos.php";

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$paymentId = null;

/** FORMATO 1: payment.created o payment.updated */
if (!empty($data["data"]["id"])) {
    $paymentId = $data["data"]["id"];
}

/** FORMATO 2: payment (legacy) */
if (isset($data["topic"]) && $data["topic"] === "payment" && !empty($data["resource"])) {
    $paymentId = $data["resource"];
}

/** FORMATO 3: merchant_order */
if (isset($data["topic"]) && $data["topic"] === "merchant_order") {
    // NO PROCESAMOS ESTO PORQUE NO ES PAGO
    file_put_contents(__DIR__."/webhook.log", "merchant_order ignorado\n\n", FILE_APPEND);
    http_response_code(200); 
    exit;
}

if (!$paymentId) {
    file_put_contents(__DIR__."/webhook.log", "NO SE ENCONTRO paymentId\n\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

// Obtener detalles del pago
$url = "https://api.mercadopago.com/v1/payments/".$paymentId;

$opts = [
    "http" => [
        "header" => "Authorization: Bearer ".getenv('MP_ACCESS_TOKEN_TEST')
    ]
];

$response = file_get_contents($url, false, stream_context_create($opts));
$pago = json_decode($response, true);

file_put_contents(__DIR__."/webhook.log", "Pago recibido:\n".print_r($pago, true)."\n", FILE_APPEND);

if (!isset($pago["status"])) {
    file_put_contents(__DIR__."/webhook.log", "Pago inválido o vacío\n\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

$pedidoId = $pago["external_reference"];

$pagos = new Pagos();
$resultado = $pagos->registrarPago($pedidoId, $pago);

file_put_contents(__DIR__."/webhook.log", "Resultado insert: ".print_r($resultado, true)."\n", FILE_APPEND);

http_response_code(200);
exit;

