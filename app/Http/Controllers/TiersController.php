<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Tiers;

class TiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // // Makany any amin'ny liste
        $data['plans'] = Tiers::getAll();
        $data['title'] = "Compte tiers";
        return view('pages.tiers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $data['title'] = 'Ajouter un compte';
        return view('pages.tiers.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Eto no manantso modele amin'izay
        // $tier = new Tier( trim($request->input('idcompte')) ,  , trim($request->input('libelle')));
        $a = trim($request->input('compte'));
        $b = trim($request->input('libelle'));
        try{
            Tiers::insert($a , $b);
            return redirect('tiers-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
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
    public function edit(string $id)
    {
        //
        $tier = Tiers::getById($id);
        $data['compte'] = $tier;
        $data['title'] = "Modifier " . $tier->numero;

        return view('pages.tiers.update')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        //
        // $row = Tiers::find($id);
        // $row->modify(  , trim($request->input('nom')) , trim($request->input('libelle')) );
        $a = trim($request->input('idplan'));
        $b = trim($request->input('compte'));
        $c = trim($request->input('libelle'));
        try{
            Tiers::modif($a,$b,$c);
            return redirect('tiers-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try{
            Tiers::remove($id);
            return redirect('tiers-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
}
