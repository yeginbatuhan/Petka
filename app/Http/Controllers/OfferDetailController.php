<?php

namespace App\Http\Controllers;

use App\Models\OfferDetail;
use Illuminate\Http\Request;

class OfferDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index($id)
  {

    $offerDetail = new OfferDetail();
    return response()->json($offerDetail->offer_detail_page($id), 200);
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
     * @param  \App\Models\OfferDetail  $offerDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OfferDetail $offerDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferDetail  $offerDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferDetail $offerDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferDetail  $offerDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferDetail $offerDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferDetail  $offerDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferDetail $offerDetail)
    {
        //
    }
}
