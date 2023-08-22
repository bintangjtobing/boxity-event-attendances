<?php

namespace App\Repository\superadmin;

use App\Admins;
use App\Purchases;
use Exception;

class DashboardRepository
{
    function getRevenue() {
        $data = Purchases::sum('amount');
        return $data;
    }

    function getOrder() {
        $data = Purchases::count();
        return $data;
    }

    function getWeeklySales() {
        $date = \Carbon\Carbon::now();
        $end_of_week = $date->endOfWeek();
        $start_of_week = $date->clone()->startOfWeek();
        $data = Purchases::whereBetween('date', [$start_of_week, $end_of_week])->count();
        return $data;
    }

    function getEmployee() {
        $data = Admins::count();
        return $data;
    }

    function getPurchases() {
        $data = Purchases::where('payment_status', 0)->orderBy('date', 'asc')->get()->take(5);
        return $data;
    }

    function getRevenueThisMonth() {
        $date = \Carbon\Carbon::now();
        $start_of_month = $date->startOfMonth();
        $end_of_month = $date->clone()->endOfMonth();
        $data = Purchases::whereBetween('date', [$start_of_month, $end_of_month])->sum('amount');
        return $data;
    }

    function getRevenuePercentage() {
        $date = \Carbon\Carbon::now();
        $now = $date->format('m');
        $previous_month = $date->clone()->subMonth();
        $sum_now = Purchases::whereMonth('date', $now)->sum('amount');
        $total = Purchases::whereMonth('date', $previous_month)->sum('amount');
        $percentage = 0;
        if ($total != 0) {
            $percentage = (($sum_now/$total)*100);
            }
        return $percentage;
    }
}
