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
    /**** Méthode GET *****/
    /*************************************************************************/
    // Méthode 1 - Afficher la liste des sports
    /*
    public function index()
    {
        $sports = Sport::all();
        return new SportResource($sports);
    }
    */

    // Méthode 2 - Afficher la liste des sports
    public function index()
    {
      $sports = DB::table('sports')
                // ->select('sports.name', 'sports.id')
                ->get()
                ->toArray();
      
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
    

    
    public function show(Sport $sport)
    {
        //
    }

   
    public function update(Request $request, Sport $sport)
    {
        //
    }

  
    public function destroy(Sport $sport)
    {
        //
    }
}
