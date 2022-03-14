<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Sport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\SportRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SportResource;

class SportController extends Controller
{
    /*************************************************************************/
    /**** Méthode GET - Afficher la liste des sports *****/
    /*************************************************************************/
    // Méthode 1
    /*
    public function index()
    {
        $sports = Sport::all();
        return new SportResource($sports);
    }
    */

    // Méthode 2
    public function index()
    {
      $sports = DB::table('sports')
                // ->select('sports.name', 'sports.id')
                ->get()
                ->toArray();

      /* Si Jointure avec table catégorie
      $sports = DB::table('sports')
                ->join('categories', 'sports.category_id', '=', 'categories.id')
                ->select('sports.*', 'categories.name')
                ->get()
                ->toArray();
      
      */
      
      return response()->json([
        'status' => 'Success',
        'data' => $sports,
      ]);

    }



    /*************************************************************************/
    /**** Méthode POST *****/
    /*************************************************************************/
    /*
    // Méthode 1 - POST Ajouter un sport
    public function store(SportRequest $request)
    {
        $sport = Sport::create($request->validated());
        return new SportResource($sport);
    }
    */
    
    /*
    // Méthode 2 - POST Ajouter un sport
    public function store(Request $request)
    {
      $request->validate([ 
        'name'=>'required', 
      ]);
      
      $sport = Sport::create([
        'name' => $request->name,
      ]);

      // 2eme façon de faire
      // $input = $request->all();
      // $sport = Sport::create($input);
  
      return new SportResource($sport);
    }
    */

    
    // Méthode 3 - POST Ajouter un sport
    public function store(Request $request)
    {
      $input = $request->all();
   
      $validator = Validator::make($input, [
          'name' => 'required',
      ]);

      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());       
      }

      $sport = Sport::create($input);

      return response()->json([
        'status' => 'Success',
        'data' => $sport,
      ]);

    }
    

    /*************************************************************************/
    /**** Méthode GET - Afficher la fiche d'sport*****/
    /*************************************************************************/
    // Méthode 1
    /*
    public function show(Sport $sport)
    {
      $sport = Sport::find($sport);

      if(is_null($sport)) {
        return $this->sendError("Ce sport est n'est pas disponible");
      }
      return new SportResource($sport);
    }
    */

    // Méthode 2
    public function show(Sport $sport)
    {
      $sport = Sport::find($sport);

      if(is_null($sport)) {
        return $this->sendError("Ce sport est n'est pas disponible");
      }
      return response()->json([
        'status' => 'Success',
        'data' => $sport,
      ]);

    }

    /*************************************************************************/
    /**** Méthode PUT - Mettre à jour une fiche sport *****/
    /*************************************************************************/
    /* Méthode 1   
    public function update(SportRequest $request, Sport $sport)
    {
      $sport->update($request->validated());
      
      return new SportResource($sport);
    }
    */
    
    // Méthode 2 
    /*
    public function update(Request $request,Sport $sport)
    {
      $updateSport = $request->validate([ 
        'name'=>'required', 
      ]);

      Sport::whereId($sport->id)->update($updateSport);
      return new SportResource($sport);
    }
    */
    

    // Méthode 3
    public function update(Request $request,Sport $sport)
    {
      $input = $request->all();
   
      $validator = Validator::make($input, [
          'name' => 'required',
      ]);

      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());       
      }

      $sport->name = $input['name'];
      $sport->save();

      /* Si il y a un FK
      $sport->name = $input['name'];
      $sport->category_id = $input['category'];
      $sport->save();
      */

      return response()->json([
        'status' => 'Mise à jour avec succèss']);
    }
    
  
    public function destroy(Sport $sport)
    {
        //
    }
}
