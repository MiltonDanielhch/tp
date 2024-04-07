<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Route;

class OrganizationRouteController extends Controller
{
    public function edit($id)
    {
        $organizacion = Organization::findOrFail($id);
        $rutas = Route::all();

        return view('organizacion.rutas', compact('organizacion', 'rutas'));
    }
}
