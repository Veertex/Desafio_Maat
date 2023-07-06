<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;

class ExportCollection implements FromCollection
{
    use Exportable;

    /*SE DEFINE UNA COLECCION VACIA PARA LOS USUARIOS PARA LUEGO SER
    REDEFINIDA Y EXPORTADA EN EL CONTROLADOR*/
    protected Collection $userCollection;

    /*SE GENERA UN CONSTRUCTOR PARA CONTROLAR DE MEJOR MANERA DESDE
    EL CONSTRUCTOR QUE COLECCION VAMOS A EXPORTAR*/
    public function __construct(Collection $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    /*METODO POR DEFECTO QUE SE DEFINE AL IMPLEMENTAR
    LA INTERFAZ FROMCOLLECTION*/
    public function collection()
    {
        return $this->userCollection;
    }
}
