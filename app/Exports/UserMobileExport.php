<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserMobileExport implements FromArray, WithHeadings
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
            "Name",
            "Username",
            "Email",
            "MobilePhone",
            "Is_Active",
            "NamaNIK",
            "TanggalLahir",
            "Alamat",
            "Status",
            "StatusNoHP",
            "Subscribe",
            "Job",
            "Last_Login"
        ];
    }
}
