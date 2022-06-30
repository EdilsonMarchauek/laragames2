<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReportsRepositoryInterface;
use Illuminate\Http\Request;

class ReportsApiController extends Controller
{
    protected $repository;

    public function __construct(ReportsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function months(Request $request)
    {
        //Casting - especificando que o valor será um inteiro
        //$year = (int) $request->input('year', date('Y'));
        $year = (int) $request->input('year', 2021);

        //Pega o valor do year passado ou 2018 pré-fixado
        $response = $this->repository->getReportsMonthByYear($year);
        
        return response()->json($response);

    }
}
