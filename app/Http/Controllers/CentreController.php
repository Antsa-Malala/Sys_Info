<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centre;
class CentreController extends Controller
{
    public function __construct(){
        $this->limit = 7;    
    }
    public function insert_form()
    {
        $data['title'] = 'Ajouter un centre';
        return view('pages.centre.insert')->with($data);
    }
    public function insert(Request $request)
    {

        $nom = trim($request->input('nom_centre'));
        Centre::insert($nom);
        return redirect('centre-list');
    }
    public function importCSV(Request $request){
        $csv = $request->file('csv');
        $extension = $csv->extension();
        if( strcmp($extension , "csv") != 0 && strcmp($extension, "xls") !=0 ){
            // throw new \Exception("Veuillez importer un fichier csv");
            return back()->withErrors("Veuillez importer un fichier csv");
        }
        // echo $csv->getPathName();
        $file = fopen($csv->getPathName() , 'r');
        fgetcsv($file);
        DB::beginTransaction();
        try{
            while( $line = fgetcsv($file) ){
                //var_dump($line);
                Centre::insert( trim($line[0]) );
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        fclose($file);
        return redirect('centre-list');
    }
    public function index( $page = 1 ){
        $data['title'] = 'Centre';
        $a = $page;
        $page = $this->limit * ($page - 1);
        $data['centre1'] = Centre::getAll();
        $data['centres'] = Centre::getAllLimited( $this->limit, $page  );
        $pages = ceil( count($data['centre1']) /  $this->limit );
        $data['current'] = $a;
        $data['pages'] = $pages;
        return view('pages.centre.index')->with($data); 
    }
    public function remove(string $idcentre){

        try{
            Centre::remove($idcentre);
            return redirect('centre-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
    public function modifier(string $id){
        $centre = Centre::getById($id);
        $data['centre'] = $centre;
        $data['title'] = "Modifier ".$centre->nomcentre;
        return view('pages.centre.update')->with($data);
    }
    public function update(Request $request){
        $a= trim($request->input('idcentre'));
        $b = trim($request->input('nomcentre'));
        try{
            Centre::modifier($a,$b);
            return redirect('centre-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function modifier_pourcentage() {
        $data['title'] = 'Modifier le pourcentage';
        $data['centres'] = Centre::getAll();
        return view('pages.centre.pourcentage_centre')->with($data);
    }
}
