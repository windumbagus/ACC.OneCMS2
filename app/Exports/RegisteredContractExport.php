<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegisteredContractExport implements FromArray, WithHeadings
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
            "CONTRACT NO",
            "V ACCOUNT",
            "POLICE NO",
            "TOTAL PAYMENT",
            "AMOUNT OF AR",
            "POLIS INSURANCE",
            "AMOUNT INSTALLMENT OVD",
            "INFO PLAFON",
            "AMT ACP",
            "NAME INSU_CO",
            "AMT INSTALLMENT PAID",
            "FLAG BAYAR",
            "BILL NO",
            "BILL DATE",
            "BILL EXP",
            "BILL DESC",
            "BILL AMOUNT",
            "TENOR",
            "CURRENCY ID",
            "PAYMENT TYPE",
            "PAYMENT PLAN",
            "PAYMENT METHOD",
            "PAYMENT DETAIL",
            "SIGNATUREDEBIT",
            "SIGNATUREDEBIT2",
            "SIGNATURECREDIT",
            "MERCHANTID",
            "MERCHANTNAME",
            "FLAG SYARIAH",
            "CURRENT INSURANCE",
            "CUSTNAME",
        ];
    }
}
