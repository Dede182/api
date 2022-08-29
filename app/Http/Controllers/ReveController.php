<?php

namespace App\Http\Controllers;

use App\Models\Reve;
use App\Http\Requests\StoreReveRequest;
use App\Http\Requests\UpdateReveRequest;

class ReveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reve  $reve
     * @return \Illuminate\Http\Response
     */
    public function show(Reve $reve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reve  $reve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reve $reve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReveRequest  $request
     * @param  \App\Models\Reve  $reve
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReveRequest $request, Reve $reve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reve  $reve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reve $reve)
    {
        //
    }
}
