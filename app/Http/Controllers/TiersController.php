<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Tier;

class TiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // // Makany any amin'ny liste
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // Makany any amin'ny add
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Eto no manantso modele amin'izay
        $tier = new Tier( trim($request->input('idcompte')) , trim($request->input('nom')) , trim($request->input('libelle')));
        if( $tier->save() ){
            return redirect('/tiers');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
        $tier = Tier::find($id);
        return 2;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
        $tier = Tier::find($id);
        return 3;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
        $row = Tier::find($id);
        $row->modify( trim($request->input('idcompte')) , trim($request->input('nom')) , trim($request->input('libelle')) );
        if( $row->save() ){
            return redirect('/tiers');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $tier = Tier::find($id);
        if( $tier->delete() ){
            return redirect('/tiers');
        }
    }
}
