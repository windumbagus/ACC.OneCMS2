<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MultipurposeExport implements FromArray, WithHeadings
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
            "Username",
            "Transaction Date",
            "Brand",
            "Kode Brand",
            "Type",
            "Kode Type",
            "Model",
            "Kode Model",
            "Tahun",
            "Tenors",
            "Installment",
            "MRP",
            "Dana",
            "Tujuan",
            "Lokasi",
            "Unit",
            "Flag New Exist",
            "Status",
            "Status Detail",
            "Flag BPKB",
            "Notes",
        ];
    }
}
