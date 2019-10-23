<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewCarExport implements FromArray, WithHeadings
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
            'Username',
            'Transaction Date',
            'Brand',
            'Kode Brand',
            'Type',
            'Kode Type',
            'Model',
            'Kode Model',
            'Tahun',
            'Tenors',
            'Installment',
            'OTR',
            'DP',
            'Amount DP',
            'Area',
            'Cabang',
            'TDP',
            'Flag ACP',
            'Flag Asuransi',
            'Status',
            'Status Detail',
            'Notes',
        ];
    }
}
