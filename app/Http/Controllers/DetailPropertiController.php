<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class DetailPropertiController extends Controller
{
    public function show($id)
    {
        // Fetch the property by ID
        $property = Property::find($id);

        // Check if the property exists
        if (!$property) {
            return redirect()->back()->with('error', 'Property not found.');
        }

        // Pass the property to the view
        return view('user.property.detail', compact('property'));
    }
}
