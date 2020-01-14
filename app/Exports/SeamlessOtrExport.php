<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessOtrExport implements FromArray, WithHeadings
{

    private $X;

    public function __construct($X)
    {
        $this->data = $X;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [

            "ID_UNIT",
            "CD_AREA",
            "OTR",
            "ID_USER_ADDED",
            "ID_USER_UPDATED",
            "CD_BRAND",
            "CD_TYPE",
            "CD_MODEL",
            "TAHUN",
            
        ];
    }
}
