<?php

namespace App\Http\Controllers\Api;

use App\Models\Soda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Soda\SodaResource;

class SodasController extends Controller
{
    public function get()
    {
        $sodas = Soda::orderBy('name','desc')->get();

        return SodaResource::collection($sodas);
    }
}
