<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sport;
// use Illuminate\Http\Request;

use App\Http\Requests\SportRequest;
use App\Http\Resources\SportResource;


class SportController extends Controller
{
   
    public function index()
    {
        //
    }

  
    // POST Ajouter un sport
    public function store(SportRequest $request)
    {
        $sport = Sport::create($request->validated());
        return new SportResource($sport);
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
