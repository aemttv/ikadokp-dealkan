<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PropertiBaruController extends Controller
{
    function viewPrimary()
    {
        $primary = Property::where('isPrimary', 1)->where('statusListing', 1)->paginate(9);

        return view('user.property.primary', ['primary' => $primary]);
    }

    public function primarySearch(Request $request)
    {
        // Validate the input
        $request->validate([
            'direction' => 'nullable|numeric|in:0,1,2,3,4',
        ]);

        // Get the selected direction
        $directionKey = $request->input('direction', 0); // Default to "Semua" (0)

        // If direction is "Semua", skip filtering
        $primary = Property::query()
            ->where('statusListing', 1)
            ->where('isPrimary', 1)
            ->when($directionKey != 0, function ($query) use ($directionKey) {
                // Filter by orientasiID using the mapped value
                $query->where(function ($subQuery) use ($directionKey) {
                    $subQuery->where('orientasiID', '=', $directionKey);
                });
            })
            ->paginate(9);

        // Pass data to the view
        return view('user.property.primary', compact('primary', 'directionKey'));
    }
    public function primaryAdminSearch(Request $request)
    {
        if(!FacadesAuth::check()){
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'Pencarian' => 'nullable|string|max:255',
        ]);

        $keyword = $request->input('Pencarian'); // Default to 'dijual'

        // Mapping for 'orientasiID' values
        $hadapType = [
            1 => 'Barat',
            2 => 'Selatan',
            3 => 'Timur',
            4 => 'Utara',
            0 => 'Unknown',
            null => 'Unknown',
        ];

        // Reverse the mapping with lowercase keys for case-insensitivity
        $reverseHadapType = array_change_key_case(array_flip($hadapType), CASE_LOWER);

        // Convert keyword to lowercase for comparison
        $orientasiID = $reverseHadapType[strtolower($keyword)] ?? null;

        // Fetch properties based on the keyword or the mapped 'orientasiID'
        $primary = Property::join('users', 'listing.agentID', '=', 'users.id')
            ->where('statusListing', 1)
            ->where('isPrimary', 1)
            ->where(function ($query) use ($keyword, $orientasiID) {
                // Case-insensitive search for title
                $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($keyword) . '%']);

                if ($orientasiID !== null) {
                    // Include orientasiID condition
                    $query->orWhere('orientasiID', $orientasiID);
                }
            })
            ->paginate(10);

        // Pass data to the view
        return view('admin.property.primary.index', compact('primary', 'keyword'));
}

}
