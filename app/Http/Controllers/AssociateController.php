<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Organization;
use App\Models\Route;

class AssociateController extends Controller
{
    public function showDetails($id)
    {
        $asociados = Associate::with('vehicles')
        ->findOrFail($id);
        //Obtener la organización del asociado con las rutas asociadas
        $organization = $asociados->organization()->with('routes')->first();

        //Encontrar las rutas que no están asociadas con la organización del asociado
        $routes = Route::whereDoesntHave('organizations', function ($query) use ($organization) {
            $query->where('organizations.id', $organization->id);
        })->get();
        if (!$asociados->active) {
            $error = 'El asociado no se encuentra activo';
            return view('asociados.show', ['asociados' => $asociados, 'error' => $error]);
        }

        // Renderizar la vista con los datos obtenidos
        return view('asociados.show', compact('asociados', 'organization', 'routes'));
    }
    public function showQrCode($id)
    {
        $asociados = Associate::findOrFail($id);
        if (!$asociados->active) {
            $error = 'El asociado no está activo';
             return view('associates.show', ['asociados' => $asociados, 'error' => $error]);
        }

        $qr = QrCode::size(300)->generate(route('associates.showDetails', $asociados->id));
        return view('asociados.qr', ['asociados' => $asociados, 'qr' => $qr]);
    }
}
