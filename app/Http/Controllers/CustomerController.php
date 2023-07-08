<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Resources\CustomerResource;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer');
    }

    public function data(Request $request)
    {
        $data = User::where('first_name', 'LIKE', "%{$request->search}%")
        ->where("account_role", "=","customer")
        ->orWhere('phone', 'LIKE', "%{$request->search}%")
        ->orWhere('last_name', 'LIKE', "%{$request->search}%")
        ->orWhereHas('customer', function($q) use($request){
            $q->where("address",'LIKE', "%{$request->search}%");
        })->orderBy('first_name','ASC');
        return CustomerResource::collection($data->paginate($request->jumlah ?? 10, ['*'], 'page', $request->page ?? 1));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->id == null) {
            $user = User::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'phone'         => $request->phone,
            ]);

            $user->customer()->create([
                'address' => $request->address
            ]);
        }else{
            $user = User::findOrFail($request->id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'phone'         => $request->phone,
            ]);

            Customer::firstOrCreate([
                "id" =>$request->id
            ],[
                'address'   => $request->address
            ]);
        }

        return [
            "status" => true
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        return [
            "status" => true
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = User::find($request->id);

        if($data->customer && $data->customer->order())
        {
            $data->customer->order()->delete();
        }
            $data->delete();

        return [
            "status" => true,
            "data" =>$data
        ];
    }
}
