<?php
/**
 * Catalogos class
 * Maneja los catálogos en PDF asociados a marcas
 */
class Catalogos
{

    public $Id_Catalogo;
    public $Id_Marca;
    public $Titulo;
    public $Archivo_PDF;
    protected $obj;

    public function __construct($id = 0)
    {
        if ($id != 0) {
            $this->obj = new sQuery();
            $result = $this->obj->executeQuery("SELECT * FROM catalogos WHERE Id_Catalogo = '$id'");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $this->Id_Catalogo = $row['Id_Catalogo'];
                $this->Id_Marca = $row['Id_Marca'];
                $this->Titulo = $row['Titulo'];
                $this->Archivo_PDF = $row['Archivo_PDF'];
            }
        }
    }

    public function getCatalogos()
    {
        $this->obj = new sQuery();
        // Hacemos JOIN con marcas para traer el nombre de la marca
        $query = "SELECT c.*, m.Nombre as Marca_Nombre FROM catalogos c LEFT JOIN marcas m ON c.Id_Marca = m.Id_Marca ORDER BY c.Id_Catalogo DESC";
        $result = $this->obj->executeQuery($query);
        return $result;
    }

    public function getCatalogosByMarca($id_marca)
    {
        $this->obj = new sQuery();
        $query = "SELECT c.*, m.Nombre as Marca_Nombre FROM catalogos c LEFT JOIN marcas m ON c.Id_Marca = m.Id_Marca WHERE c.Id_Marca = '$id_marca' ORDER BY c.Id_Catalogo DESC";
        $result = $this->obj->executeQuery($query);
        return $result;
    }

    public function insertCatalogo($id_marca, $titulo, $archivo_pdf)
    {
        $this->obj = new sQuery();
        $this->obj->executeQuery("INSERT INTO catalogos (Id_Marca, Titulo, Archivo_PDF) VALUES ('$id_marca', '$titulo', '$archivo_pdf')");
        return $this->obj->getIDAffect();
    }

    public function updateCatalogo($id_catalogo, $id_marca, $titulo, $archivo_pdf = null)
    {
        $this->obj = new sQuery();
        if ($archivo_pdf) {
            $this->obj->executeQuery("UPDATE catalogos SET Id_Marca = '$id_marca', Titulo = '$titulo', Archivo_PDF = '$archivo_pdf' WHERE Id_Catalogo = '$id_catalogo'");
        } else {
            $this->obj->executeQuery("UPDATE catalogos SET Id_Marca = '$id_marca', Titulo = '$titulo' WHERE Id_Catalogo = '$id_catalogo'");
        }
    }

    public function deleteCatalogo($id_catalogo)
    {
        // Obtener para borrar archivo físico si se desea luego
        $c = new self($id_catalogo);
        $archivo = $c->Archivo_PDF;

        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM catalogos WHERE Id_Catalogo = '$id_catalogo'");
        
        return $archivo;
    }

    public function closeConnection()
    {
        $this->obj->Clean();
        $this->obj->Close();
    }
}
