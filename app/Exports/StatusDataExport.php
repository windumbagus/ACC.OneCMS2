<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatusDataExport implements FromArray, WithHeadings
{

    private $data2;

    public function __construct($data2)
    {
        $this->data = $data2;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            "Name",
            "Registration No",
            "Id",
            "Status",
            "Date",
        ];
    }
}
