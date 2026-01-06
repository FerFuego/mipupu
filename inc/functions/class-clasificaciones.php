<?php
/**
 * Clasificaciones class
 */
class Clasificaciones
{

    public $id_clasificacion;
    public $nombre;
    public $no_borra;
    protected $obj;

    public function __construct($id = 0)
    {

        if ($id != 0) {

            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM clasificaciones WHERE Id_Clasificacion = '$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $this->id_clasificacion = $row['Id_Clasificacion'];
                $this->nombre = $row['Nombre'];
                $this->no_borra = $row['NoBorra'];
            }
        }
    }

    public function getID()
    {
        return $this->id_clasificacion;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getBorra()
    {
        return $this->no_borra;
    }

    public function getClasificaciones()
    {
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM clasificaciones ORDER BY Nombre");
        return $result;
    }

    public function closeConnection()
    {
        $this->obj->Clean();
        $this->obj->Close();
    }

}
