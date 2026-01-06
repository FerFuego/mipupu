<?php
/**
 * Productos class
 */
class Productos
{

    public $id_producto;
    public $cod_producto;
    public $nombre;
    public $id_marca;
    public $marca;
    public $id_rubro;
    public $rubro;
    public $id_subrubro;
    public $subrubro;
    public $id_grupo;
    public $grupo;
    public $id_clasificacion;
    public $clasificacion;
    public $precio_venta_neto_1;
    public $precio_venta_final_1;
    public $precio_venta_neto_2;
    public $precio_venta_final_2;
    public $precio_venta_neto_3;
    public $precio_venta_final_3;
    public $fecha_alta;
    public $fecha_alta_web;
    public $novedad;
    public $oferta;
    public $stock_actual;
    public $observaciones;
    public $StockActual;
    protected $obj;

    public function __construct($id = 0)
    {

        if ($id != 0) {

            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM productos WHERE CodProducto='" . $id . "'");
            $row = mysqli_fetch_assoc($result);

            $this->id_producto = $row['Id_Producto'];
            $this->cod_producto = $row['CodProducto'];
            $this->nombre = $row['Nombre'];
            $this->id_marca = $row['Id_Marca'];
            $this->marca = $row['Marca'];
            $this->id_rubro = $row['Id_Rubro'];
            $this->rubro = $row['Rubro'];
            $this->id_subrubro = $row['Id_SubRubro'];
            $this->subrubro = $row['SubRubro'];
            $this->id_grupo = $row['Id_Grupo'];
            $this->grupo = $row['Grupo'];
            $this->id_clasificacion = $row['Id_Clasificacion'];
            $this->clasificacion = $row['Clasificacion'];
            $this->precio_venta_neto_1 = $row['PreVtaNeto1'];
            $this->precio_venta_final_1 = $row['PreVtaFinal1'];
            $this->precio_venta_neto_2 = $row['PreVtaNeto2'];
            $this->precio_venta_final_2 = $row['PreVtaFinal2'];
            $this->precio_venta_neto_3 = $row['PreVtaNeto3'];
            $this->precio_venta_final_3 = $row['PreVtaFinal3'];
            $this->fecha_alta = $row['FecAlta'];
            $this->fecha_alta_web = $row['FecAltaWeb'];
            $this->novedad = $row['Novedad'];
            $this->oferta = $row['Oferta'];
            $this->observaciones = $row['Observaciones'];
            $this->StockActual = $row['StockActual'];
        }
    }

    public function getID()
    {
        return $this->id_producto;
    }
    public function getCode()
    {
        return $this->cod_producto;
    }
    public function getRubroID()
    {
        return $this->id_rubro;
    }
    public function getSubRubroID()
    {
        return $this->id_subrubro;
    }
    public function getGrupoID()
    {
        return $this->id_grupo;
    }
    public function getClasificacionID()
    {
        return $this->id_clasificacion;
    }
    public function getMarcaID()
    {
        return $this->id_marca;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getStock()
    {
        return $this->StockActual;
    }

    public static function PreVtaFinal($precio)
    {
        $config = new Configuracion();
        $aumento = $config->getAumento();

        if (filter_var($aumento, FILTER_VALIDATE_FLOAT) && $aumento > 0) {
            $precio = $precio + ($precio * ($aumento / 100));
        }

        return $precio;
    }

    public function PreVta()
    {
        $config = new Configuracion();
        $aumento = $config->getAumento();

        // Usuario logueado
        if (isset($_SESSION["user"])) {
            $user = new Usuarios($_SESSION["Id_Cliente"]);
            $listaPrecioDef = $user->getListaPrecioDef();
            $precios = [
                1 => $this->precio_venta_final_1,
                2 => $this->precio_venta_final_2,
                3 => $this->precio_venta_final_3,
            ];
            $precio = $precios[$listaPrecioDef] ?? $this->precio_venta_final_1;
        } else {
            $precio = $this->precio_venta_final_1;
        }

        // aumento %
        if (filter_var($aumento, FILTER_VALIDATE_FLOAT) && $aumento > 0) {
            $precio = $precio + ($precio * ($aumento / 100));
        }

        return $precio;
    }

    public function getProducts($opcion, $id_rubro, $id_subrubro, $id_grupo, $minamount, $maxamount, $order, $id_marca = null, $id_clasificacion = null)
    {
        $where = '1=1';
        if (is_array($id_rubro)) {
            $where .= ' AND Id_Rubro IN (' . implode(',', $id_rubro) . ')';
        } else {
            $where .= ($id_rubro) ? ' AND Id_Rubro=' . $id_rubro : '';
        }
        $where .= ($id_subrubro) ? ' AND Id_SubRubro=' . $id_subrubro : '';
        $where .= ($id_grupo) ? ' AND Id_Grupo=' . $id_grupo : '';
        if (is_array($id_marca)) {
            $where .= ' AND Id_Marca IN (' . implode(',', $id_marca) . ')';
        } else {
            $where .= ($id_marca) ? ' AND Id_Marca=' . $id_marca : '';
        }
        if (is_array($id_clasificacion)) {
            $where .= ' AND Id_Clasificacion IN (' . implode(',', $id_clasificacion) . ')';
        } else {
            $where .= ($id_clasificacion) ? ' AND Id_Clasificacion=' . $id_clasificacion : '';
        }
        $where .= ($minamount && $maxamount) ? ' AND PreVtaFinal1 BETWEEN ' . $minamount . ' AND ' . $maxamount : '';
        $orderBy = ($order) ? ' ORDER BY Id_Rubro, Id_SubRubro, Id_Grupo, PreVtaFinal1 ' . $order : ' ORDER BY Id_Rubro, Id_SubRubro, Id_Grupo, Nombre';

        $query = "SELECT * FROM productos WHERE $where $orderBy";

        $this->obj = new sQuery();
        $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => ($opcion ? 'opcion=' . $opcion . '&' : null) . (is_array($id_rubro) ? 'id_rubro[]=' . implode('&id_rubro[]=', $id_rubro) : 'id_rubro=' . $id_rubro) . '&id_subrubro=' . $id_subrubro . '&id_grupo=' . $id_grupo . (is_array($id_marca) ? '&id_marca[]=' . implode('&id_marca[]=', $id_marca) : '&id_marca=' . $id_marca) . (is_array($id_clasificacion) ? '&id_clasificacion[]=' . implode('&id_clasificacion[]=', $id_clasificacion) : '&id_clasificacion=' . $id_clasificacion) . (($minamount && $maxamount) ? '&minamount=' . $minamount . '&maxamount=' . $maxamount : '') . (($order) ? '&order=' . $order : '')
        ];
        return $result;
    }

    public function getCountProducts()
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("SELECT * FROM productos");
        return $this->obj->getResultados();
    }

    public static function getImage($CodProducto, $id_producto = null)
    {
        $extensions = ['JPG', 'jpg', 'png', 'PNG', 'webp', 'WEBP'];
        $img = "img/sin-imagen.jpg";

        if ($id_producto) {
            foreach ($extensions as $ext) {
                if (file_exists("./fotos/" . $id_producto . "." . $ext)) {
                    return "./fotos/" . $id_producto . "." . $ext;
                }
            }
        }

        foreach ($extensions as $ext) {
            if (file_exists("./fotos/" . $CodProducto . "." . $ext)) {
                return "./fotos/" . $CodProducto . "." . $ext;
            }
        }

        return $img;
    }

    public function getProductSearch($opcion, $search)
    {

        $query = "SELECT * FROM productos WHERE Nombre LIKE '%$search%' OR CodProducto LIKE '%$search%'";

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery($query);

        $result = [
            'total' => $this->obj->getResultados(),
            'query' => $query,
            'params' => ($opcion ? 'opcion=' . $opcion . '&' : null) . 's=' . $search
        ];

        return $result;
    }

    public function getProductsOffert($id_rubro, $id_subrubro, $id_grupo)
    {

        $where = 'Oferta = 1';
        if (is_array($id_rubro)) {
            $where .= ' AND Id_Rubro IN (' . implode(',', $id_rubro) . ')';
        } else {
            $where .= ($id_rubro) ? ' AND Id_Rubro=' . $id_rubro : '';
        }
        $where .= ($id_subrubro) ? ' AND Id_SubRubro=' . $id_subrubro : '';
        $where .= ($id_grupo) ? ' AND Id_Grupo=' . $id_grupo : '';

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE $where ORDER BY Nombre");

        return $result;
    }

    public function getProductNews($limit = 10)
    {

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE Novedad = 1 ORDER BY Id_Producto DESC LIMIT $limit");

        return $result;
    }

    public function getProductsOffertNews()
    {

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE Oferta = 1 OR Novedad = 1 ORDER BY RAND() LIMIT 8");

        return $result;
    }

    public function getProductstNews()
    {

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE 1 = 1 ORDER BY Id_Producto DESC LIMIT 12");

        return $result;
    }

    public function getRelatedProducts($id_rubro, $id_subrubro, $id_grupo, $id_producto)
    {

        $where = '1=1';
        $where .= ($id_rubro) ? ' AND Id_Rubro=' . $id_rubro : '';
        $where .= ($id_subrubro) ? ' AND Id_SubRubro=' . $id_subrubro : '';
        $where .= ($id_grupo) ? ' AND Id_Grupo=' . $id_grupo : '';

        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM productos WHERE $where AND Id_Producto NOT IN ($id_producto) ORDER BY Nombre Limit 4");

        return $result;
    }

    public function getResultados()
    {
        $this->obj->getResults();
    }

    public function importProducts($sql)
    {
        try {
            $this->obj = new sQuery();
            //$this->obj->executeQuery("TRUNCATE TABLE productos");
            $this->obj->executeQuery("DELETE FROM `productos` WHERE 1;");
            $this->obj->executeQuery($sql);
            return $this->obj->getResultados();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update()
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE productos SET Nombre = '$this->nombre', Id_Marca = '$this->id_marca', Marca = '$this->marca', Id_Clasificacion = '$this->id_clasificacion', Clasificacion = '$this->clasificacion', Novedad = '$this->novedad', Oferta = '$this->oferta', StockActual = '$this->stock_actual', Observaciones = '$this->observaciones' WHERE (CodProducto = '$this->cod_producto')");
    }

    public function delete()
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM productos WHERE (CodProducto = '$this->cod_producto')");
    }

    public function closeConnection()
    {
        @$this->obj->Clean();
        $this->obj->Close();
    }

}