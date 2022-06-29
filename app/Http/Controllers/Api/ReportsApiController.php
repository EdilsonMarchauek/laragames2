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
        $response = $this->repository->getReportsMonthByYear(2021);
        
        return response()->json($response);

    }
}
