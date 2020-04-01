<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccCashHistorySMSExport implements FromArray, WithHeadings
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
            "SMS_ID",
            "SMS_GROUP_ID",
            "SMS_MSG",
            "SMS_SENT",
            "SMS_PHONENOTO",
            "ID_USER_ADDED",
            "SMS_STATUS_MSG",
        ];
    }
}
