<?php

namespace App\Http\Controllers\Api;

use App\Models\Soda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Soda\SodaRequest;
use App\Http\Resources\Soda\SodaResource;

class SodasController extends Controller
{
    public function get()
    {
        $sodas = Soda::orderBy('name', 'DESC')->get();

        return SodaResource::collection($sodas);
    }

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
}
