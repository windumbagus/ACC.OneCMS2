<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeamlessDataLeadsExport implements FromArray, WithHeadings
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
<<<<<<< HEAD
            "LEADS_ID",
            "DT_ADDED",
            "NAME",
            "PHONE_NUMBER",
            "DESC_BRAND",
            "DESC_TYPE",
            "DESC_MODEL",
            "CD_SP",
            "DESC_SP",
            "TAHUN",
            "TENOR",
            "AMT_TDP",
            "AMT_INSTALLMENT",
            "AMT_OTR",
            
=======
            "LeadsID",
            "DateAdded",
            "Name",
            "PhoneNumber",
            "DescBrand",
            "DescType",
            "DescModel",
            "DescSP",
            "Tahun",
            "AmtTDP",
            "AmtInstallment",
            "AmtOTR",
>>>>>>> 74e9f9054ba56c306c82aae1dfa47eb7a1f73612
        ];
    }
}
