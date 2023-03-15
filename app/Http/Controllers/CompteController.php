<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Compte;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // return view an'ilay affichage compte tiers
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // return a view for the form creation
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $compte = new Compte( trim($request->input('numero')) , trim($request->input('libelle')) );
        if( $compte->save() ){
            return redirect('/comptes');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
        $compte = Compte::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        // Antsoina ato ilay modele
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
        $row = Compte::find($id);
        $row->modify( trim($request->input('numero')) , trim($request->input('libelle')) );
        if( $row->save() ){
            return redirect('/comptes');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
        $row = Compte::find($id);
        if( $row->delete() ){
            return redirect('/comptes');
        }
    }
}
