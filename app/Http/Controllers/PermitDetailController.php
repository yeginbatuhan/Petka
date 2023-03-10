<?php

namespace App\Http\Controllers;

use App\Models\PermitDetail;
use Illuminate\Http\Request;

class PermitDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $permitdetailpage = new PermitDetail();
      return response()->json($permitdetailpage->permit_detail_page($id), 200);
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
     * @param  \App\Models\PermitDetail  $permitDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PermitDetail $permitDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermitDetail  $permitDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PermitDetail $permitDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermitDetail  $permitDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermitDetail $permitDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermitDetail  $permitDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermitDetail $permitDetail)
    {
        //
    }
}
