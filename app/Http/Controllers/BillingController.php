<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing;
// use Illuminate\Support\Facades\Session;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = Billing::all();

    return response()->json(['data' => $users], 200);

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
        //
        $user = new Billing;
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->company_name = $request->input('company_name');
    $user->country = $request->input('country');
    $user->address1 = $request->input('address1');
    $user->address2 = $request->input('address2');
    $user->city = $request->input('city');
    $user->state = $request->input('state');
    $user->zipcode = $request->input('zipcode');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->customer_id = $request->input('customer_ids');
    $user->save();

    return response()->json(['message' => 'Billing Address created', 'data' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($columnValue)
    {
    $user = Billing::where('customer_id', $columnValue)->first();

    if (!$user) {
        return response()->json(['data'=>[]]);
    }

    return response()->json(['data' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $columnValue)
    {
        //
        $user = Billing::where('customer_id', $columnValue)->first();
    
        

    if (!$user) {
        return response()->json(['message' => 'Shipping Address not found'], 404);
    }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->company_name = $request->input('company_name');
        $user->country = $request->input('country');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->zipcode = $request->input('zipcode');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->customer_id = $request->input('customer_ids');
        $user->save();

    return response()->json(['message' => 'Billing Address updated', 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user = Billing::find($id);

        if (!$user) {
            return response()->json(['message' => 'Billing Address not found'], 404);
        }
    
        $user->delete();
    
        return response()->json(['message' => 'Billing Address'], 200);
    }
}
