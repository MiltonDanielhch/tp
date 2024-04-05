<?php

namespace App\Http\Controllers;
use App\Models\Organization;

use Illuminate\Http\Request;

class organizationsController extends Controller
{
    public function toggleActive(Organization $organization)
    {
        $organization->active = !$organization->active;
        $organization->save();

        return redirect()->back();
    }
}
