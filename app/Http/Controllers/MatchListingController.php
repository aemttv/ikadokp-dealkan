<?php

namespace App\Http\Controllers;

use App\Models\BuyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchListingController extends Controller
{
    public function show($agentID)
    {
        // Fetch the agent/user based on the ID
        $user = User::find($agentID);

        // Ensure both the user and buyRequest exist
        if (!$user) {
            abort(404, 'User not found');
        }

        // Filter matching BuyRequests for the given agentID
        $matchedRequests = BuyRequest::join('listing', 'buy_requests.listingID', '=', 'listing.listingID')
            ->where('listing.agentID', '=', $user->id)
            ->where('buy_requests.isMatched', 1)
            ->where('buy_requests.isActive', 1)
            ->get(['buy_requests.*', 'listing.*']);

        // Pass data to the view
        return view('user.buymatch.matchListing', [
            'user' => $user,
            'matchedRequests' => $matchedRequests,
        ]);
    }
    public function showMatchListing($agentID)
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            // Fetch the agent/user based on the ID
            $user = User::find($agentID);

            // Ensure both the user and buyRequest exist
            if (!$user) {
                abort(404, 'User not found');
            }

            // Filter matching BuyRequests for the given agentID
            $matchedRequests = BuyRequest::join('listing', 'buy_requests.listingID', '=', 'listing.listingID')
                ->where('buy_requests.isMatched', 1)
                ->where('buy_requests.isActive', 1)
                ->get(['buy_requests.*', 'listing.*']);

            // Pass data to the view
            return view('admin.interaction.match-listing.index', [
                'user' => $user,
                'matchedRequests' => $matchedRequests,
            ]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in showMatchListing()!');
        }
    }
}
