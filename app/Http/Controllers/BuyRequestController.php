<?php

namespace App\Http\Controllers;

use App\Models\BuyRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyRequestController extends Controller
{
    public function show($id)
    {
        // Call matchBuyRequests to update matching statuses
        $this->matchBuyRequests();

        $user = User::findOrFail($id);
        $buyRequest = BuyRequest::where('agentID', $user->id)
            ->where('isActive', '1')
            ->paginate(5);

        return view('user.buymatch.buyRequest', [
            'id' => $id,
            'buyRequest' => $buyRequest,
        ]);
    }
    public function viewAll()
    {

        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            // Call matchBuyRequests to update matching statuses
            $this->matchBuyRequests();

            $buyRequest = BuyRequest::join('users', 'buy_requests.agentID', '=', 'users.id')->
                where('isActive', '1')->orderby('buy_requests.updated_at', 'desc')->orderby('buy_requests.created_at', 'desc')
                ->paginate(10);

            return view('admin.interaction.buy-request.index', [
                'buyRequest' => $buyRequest,
            ]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewAll()!');
        }
    }

    function viewMatched($agentID, $requestID)
    {
        // Fetch the agent/user based on the ID
        $user = User::find($agentID);

        // Fetch the specific BuyRequest based on requestID
        $buyRequest = BuyRequest::find($requestID);

        // Ensure both the user and buyRequest exist
        if (!$user || !$buyRequest) {
            abort(404, 'User or BuyRequest not found');
        }

        // Filter matching BuyRequests for the given agentID
        $matchedRequests = BuyRequest::join('listing', 'buy_requests.listingID', '=', 'listing.listingID')
            ->where('buy_requests.agentID', $user->id)
            ->where('buy_requests.isMatched', 1)
            ->where('buy_requests.requestID', $buyRequest->requestID)
            ->get(['buy_requests.*', 'listing.*']);

        // Pass data to the view
        return view('user.buymatch.viewMatched', [
            'user' => $user,
            'buyRequest' => $buyRequest,
            'matchedRequests' => $matchedRequests,
        ]);
    }

    function viewRequestMatched($agentID, $requestID)
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

            // Fetch the specific BuyRequest based on requestID
            $buyRequest = BuyRequest::find($requestID);

            // Ensure both the user and buyRequest exist
            if (!$user || !$buyRequest) {
                abort(404, 'User or BuyRequest not found');
            }

            // Filter matching BuyRequests for the given agentID
            $matchedRequests = BuyRequest::join('listing', 'buy_requests.listingID', '=', 'listing.listingID')
                // ->where('buy_requests.agentID', $user->id)
                ->where('buy_requests.isMatched', 1)
                ->where('buy_requests.requestID', $buyRequest->requestID)
                ->paginate(10);

            // Pass data to the view
            return view('admin.interaction.buy-request.matched', [
                'user' => $user,
                'buyRequest' => $buyRequest,
                'matchedRequests' => $matchedRequests,
            ]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewRequestMatched()!');
        }
    }

    function addView($id)
    {
        return view('user.buymatch.create_buyRequest', ['id' => $id]);
    }
    function viewRequestBaru()
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            return view('admin.interaction.buy-request.create');
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewRequestBaru()!');
        }
    }
    function addSubmit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('profil.view')
                ->withErrors(['User not found.']);
        }

        // Create a new BuyRequest instance
        $buyRequest = new BuyRequest();

        // Assign values to the attributes
        $buyRequest->agentID = $id;
        $buyRequest->buyerName = $request->input('vendorName');
        $buyRequest->lokasiID = $request->input('lokasiID');
        $buyRequest->transaksiID = $request->input('transaksiID');
        $buyRequest->listingType = $request->input('Tipe');
        $buyRequest->hargaJualMin = $request->input('HargaTerendah');
        $buyRequest->hargaJualMax = $request->input('HargaTertinggi');
        $buyRequest->luasTanahMin = $request->input('LTMin');
        $buyRequest->luasTanahMax = $request->input('LTMax');
        $buyRequest->luasBangunanMin = $request->input('LBMin');
        $buyRequest->luasBangunanMax = $request->input('LBMax');
        $buyRequest->kamar_tidur = $request->input('kamar_tidur');
        $buyRequest->kamar_mandi = $request->input('kamar_mandi');
        $buyRequest->modified_by = $id;

        // Save the data to the database
        // @dd($buyRequest);
        $buyRequest->save();

        // Redirect to the view or page
        return redirect()
            ->route('BuyRequest.view', ['id' => $user->id])
            ->with('success', 'Buy requests added successfully!');
    }
    function requestBaru(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('profil.view')
                ->withErrors(['User not found.']);
        }

        // Create a new BuyRequest instance
        $buyRequest = new BuyRequest();

        // Assign values to the attributes
        $buyRequest->agentID = $id;
        $buyRequest->buyerName = $request->input('vendorName');
        $buyRequest->lokasiID = $request->input('lokasiID');
        $buyRequest->transaksiID = $request->input('transaksiID');
        $buyRequest->listingType = $request->input('Tipe');
        $buyRequest->hargaJualMin = $request->input('HargaTerendah');
        $buyRequest->hargaJualMax = $request->input('HargaTertinggi');
        $buyRequest->luasTanahMin = $request->input('LTMin');
        $buyRequest->luasTanahMax = $request->input('LTMax');
        $buyRequest->luasBangunanMin = $request->input('LBMin');
        $buyRequest->luasBangunanMax = $request->input('LBMax');
        $buyRequest->kamar_tidur = $request->input('kamar_tidur');
        $buyRequest->kamar_mandi = $request->input('kamar_mandi');
        $buyRequest->modified_by = $id;

        // Save the data to the database
        // @dd($buyRequest);
        $buyRequest->save();

        // Redirect to the view or page
        return redirect()
            ->route('allBuyRequest.view', ['id' => $user->id])
            ->with('success', 'Buy requests added successfully!');
    }

    function deleteRequest($requestID)
    {
        $buyRequest = BuyRequest::find($requestID);

        // Check if the buy request exists
        if (!$buyRequest) {
            return redirect()->back()->with('error', 'Buy request Gagal dihapus!');
        }

        $buyRequest->isActive = 0;
        $buyRequest->modified_by = Auth::id();
        $buyRequest->save();

        return redirect()->back()->with('success', 'Buy request berhasil dihapus!');
    }

    function editRequestShow($requestID)
    {
        $buyRequest = BuyRequest::find($requestID);

        return view('user.buymatch.update_buyRequest', compact('buyRequest'));
    }

    function editRequest(Request $request, $requestID)
    {
        $buyRequest = BuyRequest::find($requestID);

        $buyRequest->buyerName = $request->input('vendorName');
        $buyRequest->lokasiID = $request->input('lokasiID');
        $buyRequest->transaksiID = $request->input('transaksiID');
        $buyRequest->listingType = $request->input('Tipe');
        $buyRequest->hargaJualMin = $request->input('HargaTerendah');
        $buyRequest->hargaJualMax = $request->input('HargaTertinggi');
        $buyRequest->luasTanahMin = $request->input('LTMin');
        $buyRequest->luasTanahMax = $request->input('LTMax');
        $buyRequest->luasBangunanMin = $request->input('LBMin');
        $buyRequest->luasBangunanMax = $request->input('LBMax');
        $buyRequest->kamar_tidur = $request->input('kamar_tidur');
        $buyRequest->kamar_mandi = $request->input('kamar_mandi');
        $buyRequest->updated_at = now();
        $buyRequest->modified_by = Auth::id();

        $buyRequest->save();

        return view('user.buymatch.update_buyRequest', compact('buyRequest'));
    }

    public function matchBuyRequests()
    {
        // Fetch all buy requests with status 0 (pending)
        $buyRequests = BuyRequest::where('isActive', 1)->get();

        foreach ($buyRequests as $buyRequest) {
            // Query the Listing table for matches
            $matchingListing = Property::where('lokasiID', $buyRequest->lokasiID)
                ->where('transaksiID', $buyRequest->transaksiID)
                ->where('listingType', $buyRequest->listingType)
                ->whereBetween('hargaJual', [$buyRequest->hargaJualMin, $buyRequest->hargaJualMax])
                ->whereBetween('luasTanah', [$buyRequest->luasTanahMin, $buyRequest->luasTanahMax])
                ->whereBetween('luasBangunan', [$buyRequest->luasBangunanMin, $buyRequest->luasBangunanMax])
                ->whereRaw('(COALESCE(ktUtama, 0) + COALESCE(ktLain, 0)) BETWEEN ? AND ?', [$buyRequest->kamar_tidur - 3, $buyRequest->kamar_tidur + 3])
                ->whereRaw('(COALESCE(kmUtama, 0) + COALESCE(kmLain, 0)) BETWEEN ? AND ?', [$buyRequest->kamar_mandi - 3, $buyRequest->kamar_mandi + 3])
                ->where('statusListing', 1)

                ->first(); // Get the first match

            if ($matchingListing) {
                // Update the BuyRequest with the matched listingID and status
                $buyRequest->listingID = $matchingListing->listingID;
                $buyRequest->isMatched = 1; // Mark as matched
            } else {
                $buyRequest->isMatched = 0; // Mark as unmatched
                $buyRequest->listingID = null; // Clear the previous match
            }

            $buyRequest->save(); // Always save the updated BuyRequest
        }

        return redirect()->back()->with('successMatch', 'Buy requests matched successfully!');
    }
}
