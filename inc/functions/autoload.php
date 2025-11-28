<?php

// 1) Cargar MercadoPago y otras libs instaladas con Composer
require_once __DIR__ . "/../../vendor/autoload.php";

spl_autoload_register( function ($class) {
    include 'class-' . strtolower($class) . '.php';
});

/*
 * Load .env
 */
$root = $_SERVER['DOCUMENT_ROOT'];
$envFilepath = "$root/.env";

if (is_file($envFilepath)) {
    $file = new \SplFileObject($envFilepath);

    while (!$file->eof()) {
        $line = trim(str_replace('"', '', $file->fgets()));

        // Ignorar líneas vacías o comentarios
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        // Debe contener "=" para ser válida
        if (strpos($line, '=') !== false) {
            putenv($line);
        }
    }
}
?>
