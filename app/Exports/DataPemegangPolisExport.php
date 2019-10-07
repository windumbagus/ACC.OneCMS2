<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPemegangPolisExport implements FromArray, WithHeadings
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
            "Nama",
            "TanggalLahir",
            "JenisKelamin",
            "Handphone",
            "NoKTP",
            "MstPictures",
            "Email",
            "Alamat",
            "Provinsi",
            "KodePos",
            "MstStatus",
            "AddedDate",
            "UserAdded",
            "UpdatedDate",
            "UserUpdated",
            "User",
        ];
    }
}
