<?php

namespace App\Http\Controllers;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

use Illuminate\Http\Request;

class organizationsController extends VoyagerBaseController
{
   

    public function toggleActive(Organization $organization)
    {
        $user = Auth::user();
        if (!$user->hasPermission('edit_organizations')) {
            abort(403, 'No tienes Autorización');
        }
        
        $organization->active = !$organization->active;
        $organization->save();

        return redirect()->back();
    }
}
