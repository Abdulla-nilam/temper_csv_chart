<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\Importable;

class HighChartImport implements ToModel, WithCustomCsvSettings
{
    use Importable;

    public function model(array $rows)
    {
        return $rows;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
