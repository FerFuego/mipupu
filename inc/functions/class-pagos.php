<?php
/**
 * Pagos class
 */
class Pagos {
    
    public $id_pago;
    public $id_pedido;
    public $mp_payment_id;
    public $status;
    public $metodo;
    public $monto;
    public $moneda;
    public $cuotas;
    public $fecha;
    public $raw;

    protected $obj;

    /**
     * Constructor
     * Si recibe un ID, carga el pago automáticamente
     */
    public function __construct($id = 0) {

        if ($id != 0) {

            $this->obj = new sQuery();

            $sql = "SELECT * FROM pagos WHERE Id_Pago = '$id' LIMIT 1";
            
            $result = $this->obj->executeQuery($sql);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $this->id_pago       = $row['Id_Pago'];
                $this->id_pedido     = $row['Id_Pedido'];
                $this->mp_payment_id = $row['MP_Payment_ID'];
                $this->status        = $row['Status'];
                $this->metodo        = $row['Metodo'];
                $this->monto         = $row['Monto'];
                $this->moneda        = $row['Moneda'];
                $this->cuotas        = $row['Cuotas'];
                $this->fecha         = $row['Fecha'];
                $this->raw           = $row['Raw'];
            }
        }
    }

    /**
     * Registrar un pago desde MercadoPago (webhook)
     */
    public function registrarPago($pedidoId, $pagoMP) {

        $this->obj = new sQuery();

        $mp_id   = $pagoMP["id"];
        $status  = $pagoMP["status"];
        $metodo  = $pagoMP["payment_method_id"];
        $monto   = $pagoMP["transaction_amount"];
        $moneda  = $pagoMP["currency_id"];
        $cuotas  = $pagoMP["installments"];
        $raw     = $this->obj->escapeString(json_encode($pagoMP, JSON_UNESCAPED_UNICODE));

        // 1) Verificar si el pago ya existe
        $mp_id_esc = $this->obj->escapeString($mp_id);
        $sqlCheck = "SELECT Id_Pago FROM pagos WHERE MP_Payment_ID = '$mp_id_esc' LIMIT 1";

        $check = $this->obj->executeQuery($sqlCheck);

        if ($check && mysqli_num_rows($check) > 0) {
            return "duplicado";
        }

        // 2) Insertar solo si NO existe
        $sql = "INSERT INTO pagos (Id_Pedido, MP_Payment_ID, Status, Metodo, Monto, Moneda, Cuotas, Fecha, Raw) VALUES ('$pedidoId', '$mp_id', '$status', '$metodo', '$monto', '$moneda', '$cuotas', NOW(), '$raw')";

        return $this->obj->executeQuery($sql);
    }

    /**
     * Obtener todos los pagos
     */
    public function listarPagos() {
        $this->obj = new sQuery();

        $sql = "SELECT * FROM pagos AS P LEFT JOIN pedidos_cabe AS PC ON PC.Id_Pedido = P.Id_Pedido ORDER BY P.Fecha DESC";

        $result = $this->obj->executeQuery($sql);

        $pagos = [];
        while ($row = $result->fetch_object()) {
            $pagos[] = $row;
        }

        return $pagos;
    }

    /**
     * Cerrar conexiones
     */
    public function closeConnection() {
        $this->obj->Clean();
        $this->obj->Close();
    }

}
