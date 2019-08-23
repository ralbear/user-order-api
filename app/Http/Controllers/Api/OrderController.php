<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\OrderCreateRequest;

class OrderController extends Controller
{
    public function readAll(Request $request)
    {

        $orders = Auth::user()
                        ->orders()
                        ->get();

        if ($orders->isEmpty()) {
            return response('', 204);
        }

        return response()
                ->json([
                    'data' => $orders
                ], 200);
        
    }

    public function read(Request $request, $orderId)
    {
        
        $order = Order::where('id', '=', $orderId)->first();

        if (!$order) {
            return response('', 404);
        }

        if ($order->user_id != Auth::user()->id) {
            return response('', 403);
        }

        return response()
                ->json([
                    'data' => $order
                ], 200);
    }

    public function create(OrderCreateRequest $request)
    {

        $newOrder = Auth::user()->orders()->create($request->all());

        return response()
                ->json([
                    'data' => $newOrder
                ], 201);
    }
}
