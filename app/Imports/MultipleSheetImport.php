<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new RumahImport(),
            1 => new MobilImport(),
        ];
    }
}
