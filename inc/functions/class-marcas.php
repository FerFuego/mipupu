<?php
/**
 * Marcas class
 */
class Marcas
{

    public $id_marca;
    public $nombre;
    public $no_borra;
    protected $obj;

    public function __construct($id = 0)
    {

        if ($id != 0) {

            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM marcas WHERE Id_Marca = '$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $this->id_marca = $row['Id_Marca'];
                $this->nombre = $row['Nombre'];
                $this->no_borra = $row['NoBorra'];
            }
        }
    }

    public function getID()
    {
        return $this->id_marca;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getBorra()
    {
        return $this->no_borra;
    }

    public function getMarcas()
    {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM marcas ORDER BY Nombre");
        return $result;
    }

    public function closeConnection()
    {
        $this->obj->Clean();
        $this->obj->Close();
    }

}
