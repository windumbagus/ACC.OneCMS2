<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasterTransactionMobilExport implements FromArray, WithHeadings
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
            "Nama",
            "NoPolisi",
            "NamaTertanggung",
            "Kendaraan",
            "Pertanggungan",
            "HargaPertanggungan",
            "Warna",
            "ColorOnSTNK",
            "NoKontrak",
            "DueDate"
        ];
    }
}
