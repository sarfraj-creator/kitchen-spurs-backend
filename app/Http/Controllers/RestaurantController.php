<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function top(Request $request)
    {
        $start = $request->query('start_date');
        $end = $request->query('end_date');
        $limit = (int) $request->query('limit', 10); 
        $offset = (int) $request->query('offset', 0); 

        $restaurants = Restaurant::select('restaurants.*')
            ->selectSub(function ($query) use ($start, $end) {
                $query->from('orders')
                    ->selectRaw('COALESCE(SUM(order_amount), 0)')
                    ->whereColumn('orders.restaurant_id', 'restaurants.id');

                if ($start && $end) {
                    $query->whereBetween('order_time', [$start, $end]);
                }
            }, 'orders_sum_order_amount')
            ->whereExists(function ($query) use ($start, $end) {
                $query->from('orders')
                    ->select(DB::raw(1))
                    ->whereColumn('orders.restaurant_id', 'restaurants.id');

                if ($start && $end) {
                    $query->whereBetween('order_time', [$start, $end]);
                }
            })
            ->orderByDesc('orders_sum_order_amount')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($restaurants);
    }
}
