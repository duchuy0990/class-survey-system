<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class result_dssv_export implements WithMultipleSheets
{
    use Exportable;

    protected $ma_mh;
    
    public function __construct($ma_mh)
    {
        $this->ma_mh = $ma_mh;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new resultExport($this->ma_mh);

        $sheets[] = new dssvExport($this->ma_mh);

        return $sheets;
    }
}