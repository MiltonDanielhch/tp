<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class AssociateController extends Controller
{
    public function showDetails($id)
    {
        $asociados = Associate::with('vehicles')->findOrFail($id);
        if (!$asociados->active) {
            $error = 'El asociado no se encuentra activo';
            return view('asociados.show', ['asociados' => $asociados, 'error' => $error]);
        }

        return view('asociados.show', ['asociados' => $asociados]);
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
