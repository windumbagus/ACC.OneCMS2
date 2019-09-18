<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SurveyExport implements FromArray, WithHeadings
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
            "Id",
            "Name",
            "UserName",
            "Password",
            "Email",
            "MobilePhone",
            "Creation Date",
            "Last Login",
            "Is Active",
            "Bintang",
            "Komentar",
            "Last Survey Date",
            "Pilihan",
        ];
    }
}
