<?php

namespace App\Http\Controllers;

use App\Models\PetkaStockDetail;
use Illuminate\Http\Request;

class PetkaStockDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index($id)
  {

    $petka_stock_detail = new PetkaStockDetail;
    return response()->json($petka_stock_detail->petka_stock_detail_page($id), 200);
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
     * @param  \App\Models\PetkaStockDetail  $petkaStockDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PetkaStockDetail $petkaStockDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetkaStockDetail  $petkaStockDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PetkaStockDetail $petkaStockDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PetkaStockDetail  $petkaStockDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PetkaStockDetail $petkaStockDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetkaStockDetail  $petkaStockDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetkaStockDetail $petkaStockDetail)
    {
        //
    }
}
