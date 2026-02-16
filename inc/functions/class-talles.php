<?php
/**
 * Talles class
 */
class Talles {
    
    public $id_talle;
    public $nombre;
    protected $obj;

    public function __construct($id=0) {

        if ($id != 0) {
            
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM talles WHERE Id_Talle = '$id' ORDER BY Nombre");
            $row = mysqli_fetch_assoc($result);
    
            if ($row) {
                $this->id_talle = $row['Id_Talle'];
                $this->nombre   = $row['Nombre'];
            }
        }
    }

    public function getID(){ return $this->id_talle; }
    public function getNombre(){ return $this->nombre; }

    public function getTalles(){
        $this->obj = new sQuery();
        $result = $this->obj->executeQuery("SELECT * FROM talles ORDER BY Nombre");
        return $result;
    }

    public function closeConnection(){
        if ($this->obj) {
            $this->obj->Clean();
            $this->obj->Close();
        }
	} 
}
