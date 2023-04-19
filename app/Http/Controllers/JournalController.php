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
    public function __construct(){
        $this->limit = 7;    
    }
    public function index( $page = 1 ){
        // Get the index for the Journal Account
        $data['title'] = 'Codes Journaux';
        $a = $page;
        $page = $this->limit * ($page - 1);
        $data['codes1'] = Journaux::getAll();
        $data['codes'] = Journaux::getAllLimited( $this->limit, $page  );
        $pages = ceil( count($data['codes1']) /  $this->limit );
        $data['current'] = $a;
        $data['pages'] = $pages;
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
    public function show(string $id){
        $data['title'] = ' Journal du code '.$id;
        try{
            $journal = Journaux::getByCode($id);
            $journaux = Journaux::getFullJournal($id);
            $data['journaux'] = $journaux;
            $data['journal'] = $journal;
            return view('pages.journal.journal')->with($data);
        }catch(\Exception $e){
            throw $e;
        }
        // return 1;
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
    public function search(Request $request)
    {
        $recherche = $request->input('recherche');
        $recherche = strtoupper($recherche);

        $journaux = Journaux::where('code', 'LIKE', "%$recherche%")
        ->orWhere('libelle', 'LIKE', "%$recherche%")
        ->get();

        return response()->json($journaux);
    }

    public function recherche(){
        $data['title'] = "Recherche Journale";
        return view('pages.codes.recherche')->with($data);
    }
}
