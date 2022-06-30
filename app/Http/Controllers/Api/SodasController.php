<?php

namespace App\Http\Controllers\Api;

use App\Models\Soda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Soda\SodaRequest;
use App\Http\Resources\Soda\SodaResource;

class SodasController extends Controller
{

    // GET
    public function get()
    {
        // LARAVEL FETCHING
        //$list = Soda::orderBy('name', 'DESC')->get();
        //$sodas = SodaResource::collection($list);
        //return view('sodas.index', ['sodas' => $sodas]);

        // FOR JS FETCHING
        $sodas = Soda::orderBy('name', 'DESC')->get();
        return SodaResource::collection($sodas);
    }

    // STORE
    public function store(SodaRequest $request)
    {
        $soda = Soda::create([
            'name' => $request->name,
            'color' => $request->color
        ]);

        return [
            'created' => $soda->save()
        ];
    }

    // UPDATE
    public function update(Request $request, Soda $soda)
    {
        // NOTE: $soda will be the params for routes config in api.php
        // Check my route config
        return [
            'updated' => $soda->update([
                'name' => $request->name,
                'color' => $request->color
            ])
        ];
    }

    // DELETE
    public function delete(Soda $soda)
    {
        // NOTE: $soda will be the params for routes config in api.php
        // Check my route config
        return [
            'deleted' => $soda->delete()
        ];
    }
}
