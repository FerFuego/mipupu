<?php
require __DIR__."/config/mercadopago.php";

use MercadoPago\Client\Preference\PreferenceClient;

function crearPago($idPedido, $data, $order, $customer) {

    // cargar clase Pedidos
    require __DIR__."/inc/functions/class-pedidos.php";
    $pedido = new Pedidos();
    
    if (!$pedido) return false;
    
    $result = $pedido->getPedidoTotal($idPedido);
    $total = $result->Total;

    $client = new PreferenceClient();

    $preference = $client->create([
        "items" => [
            [
                "title" => "Pedido #".$idPedido,
                "quantity" => 1,
                "currency_id" => "ARS",
                "unit_price" => (float) $total
            ]
        ],
        "external_reference" => $idPedido,

        "notification_url" => "https://mipupu.com.ar/webhook-mercadopago.php",

        "back_urls" => [
            "success" => "https://mipupu.com.ar/pago-exitoso.php?id=".$idPedido,
            "pending" => "https://mipupu.com.ar/pago-pendiente.php?id=".$idPedido,
            "failure" => "https://mipupu.com.ar/pago-fallido.php?id=".$idPedido
        ],

        "auto_return" => "approved"
    ]);

    return $preference->init_point;
}