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
    public $Imagen;
    public $Texto;
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
                $this->Imagen = $row['Imagen'];
                $this->Texto = $row['Texto'];
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

    public function insertCatalogo($id_marca, $titulo, $imagen, $texto, $archivo_pdf)
    {
        $this->obj = new sQuery();
        $id_marca = (int)$id_marca;
        $titulo = $this->obj->escapeString($titulo);
        $texto = $this->obj->escapeString($texto);
        $imagen = $this->obj->escapeString($imagen);
        $archivo_pdf = $this->obj->escapeString($archivo_pdf);
        
        $this->obj->executeQuery("INSERT INTO catalogos (Id_Marca, Titulo, Imagen, Texto, Archivo_PDF) VALUES ('$id_marca', '$titulo', '$imagen', '$texto', '$archivo_pdf')");
        return $this->obj->getIDAffect();
    }

    public function updateCatalogo($id_catalogo, $id_marca, $titulo, $imagen = null, $texto = null, $archivo_pdf = null)
    {
        $this->obj = new sQuery();
        $id_catalogo = (int)$id_catalogo;
        $id_marca = (int)$id_marca;
        $titulo = $this->obj->escapeString($titulo);
        $texto = $this->obj->escapeString($texto);
        
        $sql = "UPDATE catalogos SET Id_Marca = '$id_marca', Titulo = '$titulo', Texto = '$texto'";
        if ($imagen) {
            $imagen = $this->obj->escapeString($imagen);
            $sql .= ", Imagen = '$imagen'";
        }
        if ($archivo_pdf) {
            $archivo_pdf = $this->obj->escapeString($archivo_pdf);
            $sql .= ", Archivo_PDF = '$archivo_pdf'";
        }
        $sql .= " WHERE Id_Catalogo = '$id_catalogo'";
        
        $this->obj->executeQuery($sql);
    }

    public function deleteCatalogo($id_catalogo)
    {
        // Obtener para borrar archivos físicos si se desea luego
        $c = new self($id_catalogo);
        $archivos = [
            'pdf' => $c->Archivo_PDF,
            'imagen' => $c->Imagen
        ];

        $this->obj = new sQuery();
        $this->obj->executeQuery("DELETE FROM catalogos WHERE Id_Catalogo = '$id_catalogo'");
        
        return $archivos;
    }

    public function closeConnection()
    {
        $this->obj->Clean();
        $this->obj->Close();
    }
}
