<?php

namespace App\Exports;

use App\models\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestAverageDurationPerServiceExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Request::query()
            ->select(
                'service_id',
                DB::raw('avg(duration)'),
                DB::raw('avg(kong)'),
                DB::raw('avg(proxy)')
            )
            ->groupBy('service_id')
            ->orderByDesc('request_total');
    }

    public function headings(): array
    {
        return [
          'Service ID',
          'Request AVG',
          'Kong AVG',
          'Proxy AVG',
        ];
    }
}
