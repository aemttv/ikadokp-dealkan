<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class MyListingController extends Controller
{
    private $locationMapping = [
        1 => 'Asemrowo',
        2 => 'Benowo',
        3 => 'Bubutan',
        4 => 'Bulak',
        5 => 'Dukuh Pakis',
        6 => 'Gayungan',
        7 => 'Genteng',
        8 => 'Gubeng',
        9 => 'Gunung Anyar',
        10 => 'Jambangan',
        11 => 'Karang Pilang',
        12 => 'Kenjeran',
        13 => 'Krembangan',
        14 => 'Lakarsantri',
        15 => 'Mulyorejo',
        16 => 'Pabean Cantian',
        17 => 'Pakal',
        18 => 'Rungkut',
        19 => 'Sambikerep',
        20 => 'Sawahan',
        21 => 'Semampir',
        22 => 'Simokerto',
        23 => 'Sukolilo',
        24 => 'Sukomanunggal',
        25 => 'Tambaksari',
        26 => 'Tandes',
        27 => 'Tegalsari',
        28 => 'Tenggilis Mejoyo',
        29 => 'Wiyung',
        30 => 'Wonocolo',
        31 => 'Wonokromo',
    ];
    function myListingView($id)
    {
        $user = User::find($id);
        $listingActive = Property::where('agentID', $id)->where('statusListing', '1')->orderBy('created_at', 'desc')->paginate(9); // Get all properties where agentID is $id and statusListing is accepted

        return view('user.login.mylisting', ['user' => $user, 'listingActive' => $listingActive]);
    }

    public function myListingSearch(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'Pencarian' => 'nullable|string|max:255',
        'Tipe' => 'nullable|numeric|in:1,2,3,4,5,6,7,8,9,10,11,12', // Valid types
    ]);

    // Get the keyword from the request
    $keyword = $request->input('Pencarian'); // Search keyword

    $listingType = $request->input('Tipe');
    $priceMin = $request->input('HargaTerendah');
    $priceMax = $request->input('HargaTertinggi');
    $landAreaMin = $request->input('LTMin');
    $landAreaMax = $request->input('LTMax');
    $buildingAreaMin = $request->input('LBMin');
    $buildingAreaMax = $request->input('LBMax');

    // Fetch properties based on the user ID and other filters
    $listingActive = Property::query()
        ->where('agentID', $id)    // Only listings belonging to this agent
        ->when(!empty($keyword), function ($query) use ($keyword) {
            // Perform search only when the keyword is not empty
            $mappedLocations = array_keys(
                array_filter($this->locationMapping, function ($location) use ($keyword) {
                    return stripos($location, $keyword) !== false; // Match locations
                })
            );

            $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                $subQuery
                    ->where('title', 'LIKE', "%{$keyword}%") // Match title
                    ->orWhereIn('lokasiID', $mappedLocations) // Match lokasiID from mapping
                    ->orWhere('orientasiID', 'LIKE', "%{$keyword}%"); // Match orientation
            });
        })
        ->when($priceMin && $priceMax, function ($query) use ($priceMin, $priceMax) {
            // Filter based on price range (e.g., Rp. Min - Rp. Max)
            return $query->whereBetween('hargaJual', [$priceMin, $priceMax]);
        })
        ->when($landAreaMin && $landAreaMax, function ($query) use ($landAreaMin, $landAreaMax) {
            // Filter based on land area range (e.g., m2 Min - m2 Max)
            return $query->whereBetween('luasTanah', [$landAreaMin, $landAreaMax]);
        })
        ->when($buildingAreaMin && $buildingAreaMax, function ($query) use ($buildingAreaMin, $buildingAreaMax) {
            // Filter based on building area range (e.g., m2 Min - m2 Max)
            return $query->whereBetween('luasBangunan', [$buildingAreaMin, $buildingAreaMax]);
        })
        ->when($listingType, function ($query, $listingType) {
            // Filter by property type
            return $query->where('listingType', $listingType);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(9); // Paginate results

    // Replace lokasiID with human-readable names in the results
    foreach ($listingActive as $data) {
        $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
    }

    // Pass data to the view
    return view('user.login.mylisting', compact('listingActive', 'keyword'));
}
}
