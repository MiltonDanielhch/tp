<?php

namespace App\Http\Controllers;


use App\Models\Route;
use App\Models\Organization;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class OrganizationRouteController extends Controller
{
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->hasPermission('add_routes')) {
            abort(403, 'No tienes Autorización');
        }

        $organizacion = Organization::with('routes')->findOrFail($id);
        $rutas = Route::whereDoesntHave('organizations', function ($query) use ($id) {
            $query->where('organizations.id', $id);
        })->get();

        return view('organizacion.rutas', compact('organizacion', 'rutas'));
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->hasPermission('add_routes')) {
            abort(403, 'No tienes Autorización');
        }        
        $organizacion = Organization::findOrFail($id);

        // Validar los datos de la solicitud...
        $request->validate([
            'routes' => 'required',
            'shudown_resolution' => 'nullable|file',
        ]);

        // Si hay un archivo, guárdalo y obtén su nombre
        $fileName = null;
        if ($request->hasFile('shudown_resolution')) {
            $fileName = $request->file('shudown_resolution')->store('files');
        }

        // Adjuntar la ruta y añadir el archivo a la tabla pivot
        $organizacion->routes()->attach($request->routes, ['shudown_resolution' => $fileName]);

        return redirect()->route('organizacion.rutas.edit', $organizacion);
    }   
        public function destroy($organizationId, $routeId)
        {
            $user = Auth::user();
            if (!$user->hasPermission('delete_routes')) {
                abort(403, 'No tienes Autorización');
            }
            $organizacion = Organization::findOrFail($organizationId);

            // Desasociar la ruta de la organización
            $organizacion->routes()->detach($routeId);
            
        return redirect()->route('organizacion.rutas.edit', $organizacion);
        
    }

    // Descargar el archivo de resolución
    public function download($organizationId, $routeId)
    {
        $organizacion = Organization::findOrFail($organizationId);
        $file = str_replace('/', DIRECTORY_SEPARATOR, $organizacion->routes()->where('route_id', $routeId)->first()->pivot->shudown_resolution);

        return response()->file(public_path('storage/' . $file));
    }
}
