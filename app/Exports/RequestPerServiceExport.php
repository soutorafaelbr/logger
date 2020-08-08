<?php

namespace App\Exports;

use App\models\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestPerServiceExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Request::query()
            ->select('service_id', DB::raw('count(id) as request_total'))
            ->groupBy('service_id')
            ->orderByDesc('request_total');
    }

    public function headings(): array
    {
        return [
          'Service ID',
          'Total',
        ];
    }
}
