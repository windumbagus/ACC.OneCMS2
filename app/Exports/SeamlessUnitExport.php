<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessUnitExport implements FromArray, WithHeadings
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

            "CD_BRAND",
            "DESC_BRAND",
            "CD_TYPE",
            "DESC_TYPE",
            "CD_MODEL",
            "DESC_MODEL",
            "TAHUN",
            "TYPE_MACHINE",
            "MACHINE_CAPACITY",
            "TRANSMISSION",
            "FLAG_NEWUSED",
            "ID_USER_ADDED",
            "ID_USER_UPDATED",
            "FLAG_ACTIVE",
            "DESC_PRODUCT",
            
        ];
    }
}
