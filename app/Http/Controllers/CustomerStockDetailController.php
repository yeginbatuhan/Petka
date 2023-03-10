<?php

namespace App\Http\Controllers;

use App\Models\CustomerStockDetail;
use Illuminate\Http\Request;

class CustomerStockDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index($id)
  {

    $customer_stock_detail = new CustomerStockDetail();
    return response()->json($customer_stock_detail->customer_stock_detail_page($id), 200);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerStockDetail  $customerStockDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerStockDetail $customerStockDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerStockDetail  $customerStockDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerStockDetail $customerStockDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerStockDetail  $customerStockDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerStockDetail $customerStockDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerStockDetail  $customerStockDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerStockDetail $customerStockDetail)
    {
        //
    }
}
