<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessUnitOtrExport implements FromArray, WithHeadings
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

            "CD_AREA",
            "OTR",
            "ID_USER_ADDED",
            "ID_USER_UPDATED",
            
        ];
    }
}
