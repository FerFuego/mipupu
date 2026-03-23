<?php
/**
 * Preventas class
 * Maneja los encargos/preventas realizadas por los clientes
 */
class Preventas
{

    public $Id_Preventa;
    public $Id_Cliente;
    public $Id_Marca;
    public $Nombre;
    public $Email;
    public $Telefono;
    public $Mensaje;
    public $Archivo_Imagen;
    public $Fecha;
    public $Estado;
    protected $obj;

    public function __construct($id = 0)
    {
        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM preventas WHERE Id_Preventa = '$id'");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $this->Id_Preventa = $row['Id_Preventa'];
                $this->Id_Cliente = $row['Id_Cliente'];
                $this->Id_Marca = $row['Id_Marca'];
                $this->Nombre = $row['Nombre'];
                $this->Email = $row['Email'];
                $this->Telefono = $row['Telefono'];
                $this->Mensaje = $row['Mensaje'];
                $this->Archivo_Imagen = $row['Archivo_Imagen'];
                $this->Fecha = $row['Fecha'];
                $this->Estado = $row['Estado'];
            }
        }
    }

    public function getPreventas()
    {
        $this->obj = new sQuery();
        $query = "SELECT p.*, m.Nombre as Marca_Nombre FROM preventas p LEFT JOIN marcas m ON p.Id_Marca = m.Id_Marca ORDER BY p.Id_Preventa DESC";
        $result = $this->obj->executeQuery($query);
        return $result;
    }

    public function insertPreventa($id_cliente, $id_marca, $nombre, $email, $telefono, $mensaje, $archivo_imagen = null)
    {
        $this->obj = new sQuery();
        
        $id_cliente = $id_cliente ? (int)$id_cliente : "NULL";
        $id_marca   = (int)$id_marca;
        $nombre     = $this->obj->escapeString($nombre);
        $email      = $this->obj->escapeString($email);
        $telefono   = $this->obj->escapeString($telefono);
        $mensaje    = $this->obj->escapeString($mensaje);
        $archivo_val = $archivo_imagen ? "'" . $this->obj->escapeString($archivo_imagen) . "'" : "NULL";
        
        $query = "INSERT INTO preventas (Id_Cliente, Id_Marca, Nombre, Email, Telefono, Mensaje, Archivo_Imagen, Fecha, Estado) 
                  VALUES ($id_cliente, '$id_marca', '$nombre', '$email', '$telefono', '$mensaje', $archivo_val, NOW(), 0)";
                  
        $this->obj->executeQuery($query);
        return $this->obj->getIDAffect();
    }

    public function updateEstado($id_preventa, $estado)
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("UPDATE preventas SET Estado = '$estado' WHERE Id_Preventa = '$id_preventa'");
    }

    public function deletePreventa($id_preventa)
    {
        $p = new self($id_preventa);
        $archivo = $p->Archivo_Imagen;

        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM preventas WHERE Id_Preventa = '$id_preventa'");

        return $archivo;
    }

    public function getCountOpenPreventas()
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("SELECT * FROM preventas WHERE Estado = 0");
        return $this->obj->getResultados();
    }

    public function closeConnection()
    {
        $this->obj->Clean();
        $this->obj->Close();
    }
}
