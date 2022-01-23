<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreServiceProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceProviderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceProviderRequest  $request
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceProviderRequest $request, ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
    }
}
