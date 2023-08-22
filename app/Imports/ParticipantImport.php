<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ParticipantImport implements ToModel, SkipsEmptyRows
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return [];
    }
}