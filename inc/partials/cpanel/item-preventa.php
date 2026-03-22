<tr>
    <td class="text-left font-weight-bold">#<?php echo $prev->Id_Preventa; ?></td>
    <td class="text-left"><?php echo date("d/m/Y H:i", strtotime($prev->Fecha)); ?></td>
    <td class="text-left">
        <?php echo $prev->Nombre; ?><br>
        <small class="text-muted"><?php echo $prev->Email; ?></small>
    </td>
    <td class="text-left font-weight-bold"><?php echo $prev->Marca_Nombre; ?></td>
    <td class="text-left">
        <?php if ($prev->Estado == 0): ?>
            <span class="badge badge-warning">Pendiente / Nuevo</span>
        <?php else: ?>
            <span class="badge badge-success">Procesado</span>
        <?php endif; ?>
    </td>
    <td class="text-left">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#verPreventaModal" 
            data-id="<?php echo $prev->Id_Preventa; ?>" 
            onclick="loadPreventaData(this);">
            <i class="fa fa-eye"></i> Ver Detalle
        </a>
        <a href="#" class="btn btn-danger" onclick="deletePreventa('<?php echo $prev->Id_Preventa; ?>');">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
