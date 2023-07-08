<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newOrder       = Order::where('status', 1)->count();
        $paymentSuccess = Order::where('status', 2)->count();
        $orderSuccess   = Order::where('status', 3)->count();
        $orderComplete  = Order::where('status', 4)->count();
        $orderCancel    = Order::where('status', 5)->count();
        $paymentPendding = Order::where('status', 6)->count();
        $paymentFailed  = Order::where('status', 7)->count();

        $orderDetail = OrderDetail::select('product.product_name',DB::raw('sum(qty) as total'))
        ->leftjoin('product','order_detail.product_id',"=",'product.id')
        ->groupBy('product_id','product_name')
        ->orderBy('total', 'DESC')
        ->paginate(10);

        $customer = Customer::withCount('order')->orderBy('order_count', "desc")
        ->paginate(10);


        $agent = Agent::withCount('customer')->orderBy('customer_count', 'DESC')->get();
        // dd($agent);

        return view('home', compact(
            'newOrder',
            'paymentSuccess',
            'orderSuccess',
            'orderComplete',
            'orderCancel',
            'paymentPendding',
            'paymentFailed',
            'orderDetail',
            'customer',
            'agent'
        ));
    }
}
