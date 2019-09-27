<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasterOtrExport implements FromArray, WithHeadings
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            "Id",
            "CD_BRAND",
            "DESC_BRAND",
            "CD_TYPE",
            "DESC_TYPE",
            "CD_MODEL",
            "DESC_MODEL",
            "TAHUN",
            "CD_SP",
            "CD_AREA",
            "OTR",
            "FLAG_ACTIVE",
            "DT_ADDED",
            "FLAG_NEW_USED",
        ];
    }
}
