<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MasterGcmExport implements FromArray, WithHeadings
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
            "Condition",
            "CharValue1",
            "CharDesc1",
            "CharValue2",
            "CharDesc2",
            "CharValue3",
            "CharDesc3",
            "CharValue4",
            "CharDesc4",
            "CharValue5",
            "CharDesc5",
            "AddedDate",
            "UserAdded",
            "UpdatedDate",
            "UserUpdated",
            "IsActive",
            "TimeStamp1",
            "TimeStamp2",
        ];
    }
}
