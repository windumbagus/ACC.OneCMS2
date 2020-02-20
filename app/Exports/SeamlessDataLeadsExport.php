<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessDataLeadsExport implements FromArray, WithHeadings
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
            "LeadsID",
            "DateAdded",
            "Name",
            "PhoneNumber",
            "DescBrand",
            "DescType",
            "DescModel",
            "DescSP",
            "Tahun",
            "AmtTDP",
            "AmtInstallment",
            "AmtOTR",
        ];
    }
}
