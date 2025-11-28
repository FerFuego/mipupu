<?php

require __DIR__.'/../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken($_ENV['MP_ACCESS_TOKEN_TEST']); // O TEST_ACCESS_TOKEN
