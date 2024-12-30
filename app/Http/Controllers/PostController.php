<?php

namespace App\Http\Controllers;

use App\Models\Property; // Change to your actual model if needed
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Retrieve all posts (or properties in your case)
    public function index()
    {
        return response()->json(Property::all()); // Adjust to your model
    }

    // Store a new post (or property)
    public function store(Request $request)
    {
         // Validate the request inputs
    $request->validate([
        'title' => 'required|string|max:255',
        'agentID' => 'required|integer',
        'transaksiID' => 'required|integer',
        'ownershipID' => 'required|integer',
        'listingType' => 'required|integer',
        'sertifikatType' => 'required|integer',
        'komisi' => 'required|integer', 
        'vendorName' => 'required|string|max:255',
        'VendorPhone' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'lantai' => 'required|integer',
        'lokasiID' => 'required|integer',
        'orientasiID' => 'required|integer',
        'posisiID' => 'required|integer',
        'hargaJual' => 'required|integer',
        'luasTanah' => 'required|integer',
        'luasBangunan' => 'required|integer',
        'dimensiMin' => 'nullable|integer',
        'dimensiMax' => 'nullable|integer',
        'ktUtama' => 'nullable|integer',
        'ktLain' => 'nullable|integer',
        'kmUtama' => 'nullable|integer',
        'kmLain' => 'nullable|integer',
        'carport' => 'nullable|integer',
        'deskripsi' => 'nullable|string',
        'kondisiPerabotanID' => 'nullable|integer',
        'listrikID' => 'nullable|integer',
        'image' => 'nullable|image|max:255',
        'ownershipListingID' => 'nullable|integer',
        'isPrimary' => 'required|integer',
        'isRent' => 'required|integer',
        'statusListing' => 'required|integer',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Adjust path as necessary
        $propertyData['image'] = $imagePath;
    }

    
    // Create a new property record
    Property::create([
        'title' => $request->input('title'),
        'agentID' => $request->input('agentID'),
        'transaksiID' => $request->input('transaksiID'),
        'ownershipID' => $request->input('ownershipID'),
        'listingType' => $request->input('listingType'),
        'sertifikatType' => $request->input('sertifikatType'),
        'komisi' => $request->input('komisi'),
        'vendorName' => $request->input('vendorName'),
        'VendorPhone' => $request->input('VendorPhone'),
        'alamat' => $request->input('alamat'),
        'lantai' => $request->input('lantai'),
        'lokasiID' => $request->input('lokasiID'),
        'orientasiID' => $request->input('orientasiID'),
        'posisiID' => $request->input('posisiID'),
        'hargaJual' => $request->input('hargaJual'),
        'luasTanah' => $request->input('luasTanah'),
        'luasBangunan' => $request->input('luasBangunan'),
        'dimensiMin' => $request->input('dimensiMin'),
        'dimensiMax' => $request->input('dimensiMax'),
        'ktUtama' => $request->input('ktUtama'),
        'ktLain' => $request->input('ktLain'),
        'kmUtama' => $request->input('kmUtama'),
        'kmLain' => $request->input('kmLain'),
        'carport' => $request->input('carport'),
        'deskripsi' => $request->input('deskripsi'),
        'kondisiPerabotanID' => $request->input('kondisiPerabotanID'),
        'listrikID' => $request->input('listrikID'),
        'image' => $imagePath, // Store the path of the uploaded image
        'ownershipListingID' => $request->input('ownershipListingID'),
        'isPrimary' => $request->input('isPrimary'),
        'isRent' => $request->input('isRent'),
        'statusListing' => $request->input('statusListing'),
    ]);

    return redirect()->route('homeLogin')->with('success', 'Property added successfully!');
}
}
