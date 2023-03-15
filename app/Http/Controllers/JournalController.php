<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\CodeJournal;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // Get the index for the Journal Account
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // Create a new Account
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Save the Journal Code to Database
        $journal = new CodeJournal( trim($request->input('code')) , trim($request->input('libelle')) );
        if( $journal->save() ){
            return redirect('/journal');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        // Get the details of a specific journal code
        $jo = CodeJournal::find($id);
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        // Show the form for a specific journal
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Update the specified model in database
        $row = CodeJournal::find($id);
        $row->modify( trim($request->input('code')) , trim($request->input('libelle')) );
        if( $row->save() ){
            return redirect('/journal');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Delete the object from database
        $row = CodeJournal::find($id);
        if( $row->delete() ){
            return redirect('/journal');
        }
    }
}
