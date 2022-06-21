<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReportsRepositoryInterface;

class ReportsController extends Controller
{

    private $repository;

    //Precisa alterar em provider 
    public function __construct(ReportsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function months(ReportsChart $chart)
    {
        $chart->labels(['JAN', 'FEV', 'MAR']);

        //Chamando o método do QueryBuilder / QueryBuilderReportsRepository
        $chart->dataset('2021', 'bar', $this->repository->byMonths(2021));

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
