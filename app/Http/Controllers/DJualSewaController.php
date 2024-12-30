<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class DJualSewaController extends Controller
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
    function viewJual()  {

        $jual = Property::where('transaksiID', 1)->where('isPrimary', 0)->where('statusListing', 1)->paginate(9);
        return view('user.property.dijual', ['jual' => $jual]);
    }
    function viewSewa()  {
        $sewa = Property::where('transaksiID', 0)->where('isPrimary', 0)->where('statusListing', 1)->paginate(9);
        return view('user.property.disewa', ['sewa' => $sewa]);
    }

    function jualSearch(Request $request)
    {
        $request->validate([
            'Pencarian' => 'nullable|string|max:255',
        ]);

        $keyword = $request->input('Pencarian');// Default to 'dijual'

        $listingType = $request->input('Tipe', []);
        $priceMin = $request->input('HargaTerendah', null);
        $priceMax = $request->input('HargaTertinggi', null);
        $landAreaMin = $request->input('LTMin', null);
        $landAreaMax = $request->input('LTMax', null);
        $buildingAreaMin = $request->input('LBMin', null);
        $buildingAreaMax = $request->input('LBMax', null);

        // Fetch properties based on the keyword
        $jual = Property::query()
            ->where('statusListing', 1)
            ->where('transaksiID', 1)
            ->where('isPrimary', 0)
            ->when($keyword, function ($query, $keyword) {
                // Map lokasiID to its name
                $mappedLocations = array_keys(
                    array_filter($this->locationMapping, function ($location) use ($keyword) {
                        return stripos($location, $keyword) !== false;
                    }),
                );
                $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                    $subQuery
                        ->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhereIn('lokasiID', $mappedLocations)
                        ->orWhere('orientasiID', 'LIKE', "%{$keyword}%");


                });
            })
            ->when($listingType, function ($query) use ($listingType) {
                // Filter based on property type selection (e.g., Rumah, Apart, Villa, etc.)
                return $query->whereIn('listingType', $listingType);
            })
            ->when($priceMin, function ($query, $priceMin) {
                return $query->where('hargaJual', '>=', $priceMin);
            })
            ->when($priceMax, function ($query, $priceMax) {
                return $query->where('hargaJual', '<=', $priceMax);
            })
            // Filter by land area range
            ->when($landAreaMin, function ($query, $landAreaMin){
                return $query->where('luasTanah', '>=', $landAreaMin);  // Minimum land area
            })
            ->when($landAreaMax, function ($query, $landAreaMax){
                return $query->where('luasTanah', '<=', $landAreaMax);  // Maximum land area
            })
            // Filter by building area range
            ->when($buildingAreaMin, function ($query, $buildingAreaMin){
                return $query->where('luasBangunan', '>=', $buildingAreaMin);  // Minimum building area
            })
            ->when($buildingAreaMax, function ($query, $buildingAreaMax)  {
                return $query->where('luasBangunan', '<=', $buildingAreaMax);  // Maximum building area
            })
            ->paginate(9);

                // Replace lokasiID with human-readable names in the results
            foreach ($jual as $data) {
                $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
            }

            // @dd($jual);
        // Pass source to the view
        return view('user.property.dijual' , compact('jual', 'keyword'));

    }

    function sewaSearch(Request $request)
    {
        $request->validate([
            'Pencarian' => 'nullable|string|max:255',
        ]);

        $keyword = $request->input('Pencarian'); // Default to 'dijual'

        $listingType = $request->input('Tipe');
        $priceMin = $request->input('HargaTerendah');
        $priceMax = $request->input('HargaTertinggi');
        $landAreaMin = $request->input('LTMin');
        $landAreaMax = $request->input('LTMax');
        $buildingAreaMin = $request->input('LBMin');
        $buildingAreaMax = $request->input('LBMax');

        // Fetch properties based on the keyword
        $sewa = Property::query()
            ->where('statusListing', 1)
            ->where('transaksiID', 0)
            ->where('isPrimary', 0)
            ->when($keyword, function ($query, $keyword) {
                // Map lokasiID to its name
                $mappedLocations = array_keys(
                    array_filter($this->locationMapping, function ($location) use ($keyword) {
                        return stripos($location, $keyword) !== false;
                    }),
                );
                $query->where(function ($subQuery) use ($keyword, $mappedLocations) {
                    $subQuery
                        ->where('title', 'LIKE', "%{$keyword}%")
                        ->orWhereIn('lokasiID', $mappedLocations)
                        ->orWhere('orientasiID', 'LIKE', "%{$keyword}%");
                });
            })
            ->when($listingType, function ($query) use ($listingType) {
                // Filter based on property type selection (e.g., Rumah, Apart, Villa, etc.)
                return $query->whereIn('listingType', $listingType);
            })
            ->when($priceMin, function ($query, $priceMin) {
                return $query->where('hargaJual', '>=', $priceMin);
            })
            ->when($priceMax, function ($query, $priceMax) {
                return $query->where('hargaJual', '<=', $priceMax);
            })
            // Filter by land area range
            ->when($landAreaMin, function ($query, $landAreaMin){
                return $query->where('luasTanah', '>=', $landAreaMin);  // Minimum land area
            })
            ->when($landAreaMax, function ($query, $landAreaMax){
                return $query->where('luasTanah', '<=', $landAreaMax);  // Maximum land area
            })
            // Filter by building area range
            ->when($buildingAreaMin, function ($query, $buildingAreaMin){
                return $query->where('luasBangunan', '>=', $buildingAreaMin);  // Minimum building area
            })
            ->when($buildingAreaMax, function ($query, $buildingAreaMax)  {
                return $query->where('luasBangunan', '<=', $buildingAreaMax);  // Maximum building area
            })
            ->paginate(9);

                // Replace lokasiID with human-readable names in the results
            foreach ($sewa as $data) {
                $data->lokasiName = $this->locationMapping[$data->lokasiID] ?? 'Unknown';
            }

            // @dd($jual);
        // Pass source to the view
        return view('user.property.disewa' ,compact('sewa', 'keyword'));

    }

}
