<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function months(ReportsChart $chart)
    {
        $chart->labels(['JAN', 'FEV', 'MAR']);

        $chart->dataset('2021', 'bar', [
            10, 18, 69
        ]);
        //Formato: line
        $chart->dataset('2022', 'bar', [
            12, 14, 16
        ])
        ->options([
            'backgroundColor' => '#999',
        ]);

        return view('admin.charts.chart', compact('chart'));
    }
}
