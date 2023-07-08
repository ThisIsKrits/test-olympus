<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function data(Request $request)
    {
        $data = Order::with('customer')->where('delivery_date', 'LIKE', "%{$request->tgl}%")
                ->orderBy('id','DESC');

        return OrderResource::collection($data->paginate($request->jumlah ?? 10, ['*'], 'page', $request->page ?? 1));
    }

    public function show($id)
    {
        $data = Order::find($id);

        return new OrderResource($data);
    }
}
