<?php

namespace App\Http\Controllers\Api;

use App\Models\Sport;
use Illuminate\Http\Request;
use App\Http\Requests\SportRequest;

use App\Http\Controllers\Controller;
use App\Http\Resources\SportResource;
use Validator;

class SportController extends Controller
{
   
    public function index()
    {
        //
    }

    /*************************************************************************/
    /**** Méthode POST*****/
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
