<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use App\Enum\Enum;
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
        //Importou a classe de Enum chamando o método months()
        $chart->labels(Enum::months());

        //Chamando o método do QueryBuilder / QueryBuilderReportsRepository
        $chart->dataset('2019', 'bar', $this->repository->byMonths(2019));
        $chart->dataset('2020', 'bar', $this->repository->byMonths(2020));

        //Formato: line
        $chart->dataset('2021', 'bar', $this->repository->byMonths(2021))
        ->options([
            'backgroundColor' => '#999',
        ]);

        return view('admin.charts.chart', compact('chart'));
    }

    public function months2()
    {
        //$chart = $this->repository->getReports(2016, 2018, 'line');
        $chart = $this->repository->getReports();
        
        return view('admin.charts.chart', compact('chart'));
    }

    public function year(ReportsChart $chart)
    {

        $response = $this->repository->getDataYears();

        $chart->labels($response['labels'])
                ->dataset('Relatórios de vendas', 'bar', $response['values'])
                ->backgroundColor($response['backgrounds'])
                ->color('black');
                //->dataset('Relatórios de vendas', 'line', $response['values'])
                //->backgroundColor('blue');

       
        $chart->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'callback' => $chart->rawObject('myCallback')
                            ]
                        ]
                    ]
                ] 
        ]);

        return view('admin.charts.chart', compact('chart'));
    }
}
