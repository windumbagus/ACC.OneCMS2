<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataTertanggungUtamaExport implements FromArray, WithHeadings
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
            "Id(20)",
            "Nama",
            "TanggalLahir",
            "JenisKelamin",
            "Handphone",
            "NoKTP",
            "MstPictures",
            "AddedDate(27)",
            "UserAdded(28)",
            "UpdatedDate(29)",
            "UserUpdated(30)",
            "MstDataPemegangPolis",
            "Hubungan"
        ];
    }
}
