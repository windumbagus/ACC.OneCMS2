<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatusPengajuanExport implements FromArray, WithHeadings
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
            "Name",
            "Id",
            "Registration No",
            "Registration Name",
            "Brand",
            "Type",
            "Model",
            "Kind",
            "Branch Name",
            "So Name",
            "So Phone No",
            "Tenor",
            "Amount Installment",
            "Prospect",
            "User",
        ];
    }
}
