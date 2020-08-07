<?php

namespace App\Exports;

use App\models\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestPerConsumerExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Request::query()
            ->select('consumer_id', DB::raw('count(id) as request_total'))
            ->groupBy('consumer_id')
            ->orderByDesc('request_total');
    }

    public function headings(): array
    {
        return [
          'Consumer ID',
          'Total',
        ];
    }
}
