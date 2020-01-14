<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessUnitDetailExport implements FromArray, WithHeadings
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

            "CATEGORY",
            "CD_VALUE",
            "CHAR_VALUE",
            "CHAR_DESC",
            "ID_USER_ADDED",
            "ID_USER_UPDATED",
            
        ];
    }
}
