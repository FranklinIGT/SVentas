<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{


    public function addRol(Request $request){

        $request->validate([
            'type'=>'required|string'
        ]);

        Rol::create($request->all());
        return response()->json(
            ['message'=>'rol agregado']
        );


    }

}
