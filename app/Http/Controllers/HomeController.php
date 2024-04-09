<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associate;
use App\Models\Vehicle;
use App\Models\Route;

class HomeController extends Controller
{
    public function index(){
        // Contadores
        $count = [
            'asociados' => Associate::count(),
            'vehiculos' => Vehicle::count(),
            'rutas' => Route::where('deleted_at', NULL)->count(),
        ];

        return view('welcome', compact('count'));
    }
    public function search(Request $request){

        $asociados = Associate::with('vehicles')
            ->where('ci', $request->search)
            ->first();

        if (!$asociados) {
            $vehicle = Vehicle::where('number_plate', $request->search)->first();
            if ($vehicle) {
                $asociados = Associate::with('vehicles')
                    ->where('id', $vehicle->associate_id)
                    ->first();
            }
        }

        if ($asociados) {
            if (!$asociados->active) {
                $error = 'El asociado no se encuentra activo';
                return view('search', ['asociados' => $asociados, 'error' => $error]);
            }

        }else{
            $asociados = null;
            return view('search', ['asociados' => $asociados]);
        }

        return view('search',['asociados' => $asociados]);
    }
    
}
