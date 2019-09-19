<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionHistoryExport implements FromArray, WithHeadings
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
            "Username",
            "CONTRACT NO",
            "NO INSTALLMENT",
            "DUEDATE PAYMENT",
            "AMOUNT INSTALLMENT",
            "AMOUNT INSTALLMENT PAID",
            "ACTUALDATE PAYMENT",
            "STATUS",
            "AMT CHARGE",
            "AMT PENALTY",
            "CURRENT INSTALLMENT",
            "CURRENT INSURANCE",        
        ];
    }
}
