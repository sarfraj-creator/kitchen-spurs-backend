<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\Order;

class AnalyticsController extends Controller
{
    public function topRestaurants()
    {
        $top = Restaurant::withSum('orders', 'order_amount')
            ->orderByDesc('orders_sum_order_amount')
            ->take(3)
            ->get();

        return response()->json($top);
    }

   public function orderTrends(Request $request)
{
    $restaurantId = $request->query('restaurant_id');
    $start = $request->query('start_date');
    $end = $request->query('end_date');
    $peakHour = $request->query('peak_hour');
    $minOrderAmount = $request->query('min_order_amount');

    $query = Order::selectRaw('
        DATE(order_time) as day,
        SUM(order_amount) as total,
        COUNT(*) as order_count,
        AVG(order_amount) as average_order_value,
        EXTRACT(HOUR FROM MAX(order_time)) as peak_hour
    ')
    ->where('restaurant_id', $restaurantId);

    if ($start && $end) {
        $query->whereBetween('order_time', [$start, $end]);
    }

    if ($peakHour !== null) {
        $query->whereRaw('EXTRACT(HOUR FROM order_time) = ?', [$peakHour]);
    }

    if ($minOrderAmount !== null) {
        $query->where('order_amount', '>=', $minOrderAmount);
    }

    $trends = $query
        ->groupBy(DB::raw('DATE(order_time)'))
        ->orderBy('day')
        ->get();

    return response()->json($trends);
}

}
