<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BankAccountExport implements FromArray, WithHeadings
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
            'Char Desc 1',
            'No Rekening',
            'Nama Rekening',
            'Cabang',
            'Bank Code',
            'Rekening Utama',
        ];
    }
}
