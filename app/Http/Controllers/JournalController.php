<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Journaux;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // Get the index for the Journal Account
        $data['title'] = 'Codes Journaux';
        $data['codes'] = Journaux::getAll();
        return view('pages.codes.index')->with($data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $data['title'] = "Ajouter un code";
        return view('pages.codes.create')->with($data);
        // Create a new Account
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Save the Journal Code to Database
        // $journal = new CodeJournal( trim($request->input('code')) , trim($request->input('libelle')) );
        $a = trim($request->input('code'));
        $b = trim($request->input('libelle'));
        try{
            Journaux::insert($a,$b);
            return redirect('journaux-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        // Get the details of a specific journal code
        // $jo = CodeJournal::find($id);
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        // Show the form for a specific journal
        $code = Journaux::getById($id);
        $data['code'] = $code;
        $data['title'] = "Modifier " .$code->code;
        return view('pages.codes.update')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        // Update the specified model in database
        // $row = CodeJournal::find($id);
        // $row->modify( trim($request->input('code')) , trim($request->input('libelle')) );
        // if( $row->save() ){
        //     return redirect('/journal');
        // }
        $a = trim($request->input('code'));
        $b = trim($request->input('libelle'));
        $c = trim($request->input('idcode'));
        try{
            Journaux::modif($c,$a,$b);
            return redirect('journaux-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse{

        try{
            Journaux::remove($id);
            return redirect('journaux-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
}
