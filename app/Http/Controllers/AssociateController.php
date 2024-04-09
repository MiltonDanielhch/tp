<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associate;

class AssociateController extends Controller
{
    public function showDetails($id)
    {
        $asociados = Associate::findOrFail($id);
        if (!$asociados->active) {
            $error = 'El asociado no está activo';
            return view('asociados.show', ['associados' => $asociados, 'error' => $error]);
        }

        return view('asociados.show', ['associados' => $asociados]);
    }
}
