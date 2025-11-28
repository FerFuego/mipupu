<?php
$pagosClass = new Pagos();
$pagos = $pagosClass->listarPagos();
?>

<h2>Listado de Pagos</h2>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID Pago</th>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Método</th>
            <th>Cuotas</th>
            <th>Fecha</th>
            <th>Ver JSON</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($pagos as $p): ?>
        <tr>
            <td><?= $p->Id_Pago ?></td>
            <td><?= $p->Id_Pedido ?></td>
            <td><?= $p->Nombre_Cliente ?></td>
            <td>$<?= number_format($p->Monto, 2) ?> <?= $p->Moneda ?></td>
            
            <td>
                <?php if ($p->Status == 'approved'): ?>
                    <span style="color: green; font-weight:bold;">Aprobado</span>
                <?php elseif ($p->Status == 'pending'): ?>
                    <span style="color: orange; font-weight:bold;">Pendiente</span>
                <?php else: ?>
                    <span style="color: red; font-weight:bold;">Rechazado</span>
                <?php endif; ?>
            </td>

            <td><?= strtoupper($p->Metodo) ?></td>

            <td><?= $p->Cuotas ?></td>
            <td><?= $p->Fecha ?></td>
            
            <td>
                <span onclick="getPagodata(this);" data-p="<?= $p->Id_Pago ?>" data-toggle="modal" data-target="#pagoModal" class="icon_dollar" title="Ver"></span>
                <!-- <a href="ver-pago.php?id=<?php //echo $p->Id_Pago ?>">
                    Ver detalles
                </a> -->
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
