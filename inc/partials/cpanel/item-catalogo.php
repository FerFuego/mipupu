<tr>
    <td class="text-left font-weight-bold"><?php echo $cat->Marca_Nombre; ?></td>
    <td class="text-left"><?php echo $cat->Titulo; ?></td>
    <td class="text-left">
        <?php if ($cat->Archivo_PDF): ?>
            <a href="fotos/catalogos/<?php echo $cat->Archivo_PDF; ?>" target="_blank" class="text-primary"><i class="fa fa-file-pdf-o"></i> Descargar / Ver</a>
        <?php else: ?>
            <span class="text-muted">Sin Archivo</span>
        <?php endif; ?>
    </td>
    <td class="text-left">
        <!-- Re-hacemos un bind de datos al modal pasandole los parametros guardados en atributos data-* -->
        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#catalogoModal" 
            data-id="<?php echo $cat->Id_Catalogo; ?>" 
            data-marca="<?php echo $cat->Id_Marca; ?>" 
            data-titulo="<?php echo $cat->Titulo; ?>"
            data-texto="<?php echo htmlspecialchars($cat->Texto ?? ''); ?>"
            onclick="editCatalogoModal(this);">
            <i class="fa fa-pencil"></i>
        </a>
    </td>
    <td class="text-left">
        <a href="#" class="btn btn-danger" onclick="deleteCatalogo('<?php echo $cat->Id_Catalogo; ?>');">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
