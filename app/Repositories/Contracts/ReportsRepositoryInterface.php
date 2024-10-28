<?php

namespace App\Repositories\Contracts;

interface ReportsRepositoryInterface
{
    //Assinatura do métodos
    public function byMonths(int $year):array;

    public function getReports(int $yearStart = null, int $yearEnd = null, String $type = 'bar');
  
    public function getDataYears():array;

    //Vue
    public function getReportsMonthByYear(int $year):array;

}