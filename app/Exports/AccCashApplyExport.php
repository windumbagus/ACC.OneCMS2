<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccCashApplyExport implements FromArray, WithHeadings
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
            "NoAggr",
            "Disbursement",
            "AmtInstallment",
            "Tenor",
            "TujuanPenggunaan",
            "Penyedia",
            "IDUser",
            "DTAdded",
            "IDUserUpdated",
            "DTUpdated",
            "Status",
            "Reason",
            "Btmy",
            "PhoneMobile1",
            "PhoneMobile2",
            "Area",
            "Cabang",
            "NoPolisi",
            "PefindoScore",
            "PefindoDetail",     
        ];
    }
}
