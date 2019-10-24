<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TradeInExport implements FromArray, WithHeadings
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
            "MRP",
            "Lokasi",
            "Unit",
            "Flag New Exist",
            "Flag BPKB",
            "Transaction Date Masa Depan",
            "Brand Masa Depan",
            "Kode Brand Masa Depan",
            "Type Masa Depan",
            "Kode Type Masa Depan",
            "Model Masa Depan",
            "Kode Model Masa Depan",
            "Tahun Masa Depan",
            "MRP Masa Depan",
            "Lokasi Masa Depan",
        ];
    }
}
