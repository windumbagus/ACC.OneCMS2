<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeaseExport implements FromArray, WithHeadings
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
            'Name',
            'Mobile Phone',
            'Transaction Date',
            'Brand',
            'Kode Brand',
            'Type',
            'Kode Type',
            'Model',
            'Kode Model',
            'Tahun',
            'Tenors',
            'Tujuan',
            'Flag New Used',
            'Status',
            'Status Detail',
            'Notes',
        ];
    }
}
