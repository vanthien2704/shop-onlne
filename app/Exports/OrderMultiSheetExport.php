<?php

namespace App\Exports;

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OrderMultiSheetExport implements WithMultipleSheets
{
    protected $sheet1Data, $sheet1Headings;
    protected $sheet2Data, $sheet2Headings;

    public function __construct($sheet1Data, $sheet1Headings, $sheet2Data, $sheet2Headings)
    {
        $this->sheet1Data = $sheet1Data;
        $this->sheet1Headings = $sheet1Headings;
        $this->sheet2Data = $sheet2Data;
        $this->sheet2Headings = $sheet2Headings;
    }

    public function sheets(): array
    {
        return [
            new CustomExport($this->sheet1Data, $this->sheet1Headings),
            new CustomExport($this->sheet2Data, $this->sheet2Headings),
        ];
    }
}
