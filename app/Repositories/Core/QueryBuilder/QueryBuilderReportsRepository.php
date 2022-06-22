<?php

namespace App\Repositories\Core\QueryBuilder;


use App\Enum\Enum;
use App\Charts\ReportsChart;
use Illuminate\Support\Facades\DB;
use App\Repositories\Core\BaseQueryBuilderRepository;
use App\Repositories\Contracts\ReportsRepositoryInterface;

class QueryBuilderReportsRepository extends BaseQueryBuilderRepository implements ReportsRepositoryInterface
{
    protected $table = 'orders'; 

    //Usando a BaseQueryBuilderRepository
    public function byMonths(int $year):array
    {
        $dataset = $this->db
                    ->table($this->tb)
                    //somando o total de cada mês
                    ->select(DB::raw('sum(total) as sums'), DB::raw('MONTH(date) as month'))
                    //agrupou por mês
                    ->groupBy(DB::raw('MONTH(date)'))
                    ->whereYear('date', $year)
                    //pluck especifica a coluna 
                    ->pluck('sums')
                    //->where('status', 1)
                    //->where('total', 12.2)
                    //->get();
                    ->toArray();

        /*  retorna o total de cada mês          
        $dataset = [];
        foreach($reports as $key => $value){
            $dataset[] = $value->sums;
        }
        */

        return $dataset;
    }

    public function getReports(int $yearStart = null, int $yearEnd = null, String $type = 'bar')
    {
        $chart = app(ReportsChart::class);

        $yearStart = $yearStart ?? date('Y') - 3;
        $yearEnd = $yearEnd ?? date('Y');

        $chart->labels(Enum::months());
       
        for ($year=$yearStart; $year <= $yearEnd ; $year++) { 
            //Geração de cor randômica
            $color = '#' . dechex(rand(0x000000, 0xFFFFFF));

            $chart->dataset($year, $type, $this->byMonths($year))
                    ->options([
                        'color'             => $color,
                        'backgroundColor'   => $color,
                    ]);
       }
       return $chart;
    }
}