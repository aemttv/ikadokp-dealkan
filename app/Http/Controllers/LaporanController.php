<?php

namespace App\Http\Controllers;

use App\Models\BuyRequest;
use App\Models\Property;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    function viewLaporanBuyRequest()
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = auth()->guard()->user();
        $users = User::where('status', '1')->get();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }
        try {
            // Call matchBuyRequests to update matching statuses
            $this->matchBuyRequests();

            $buyRequests = BuyRequest::join('users', 'buy_requests.agentID', '=', 'users.id')
            ->where('buy_requests.isActive', 1)
            ->SELECT('buy_requests.*', 'buy_requests.created_at as buy_request_created_at', 'buy_requests.updated_at as buy_request_updated_at', 'users.name as agent_name')->paginate(10);

            return view('admin.laporan.index', [
                'buyRequests' => $buyRequests,
                'users' => $users,
            ]);
        } catch (\Throwable $th) {
            abort(403, 'Oops..Something went wrong in viewAll()!');
        }
    }

    function searchLaporanBuyRequest(Request $request)
    {
        if(!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        $user = auth()->guard()->user();
        if ($user->role != '0') {
            abort(403, 'Unauthorized access');
        }

        // @dd($request->all());
        // Validate the inputs
        $request->validate([
            'date-start' => 'nullable|date',
            'date-end' => 'nullable|date',
            'agentID' => 'nullable|integer', // Agent ID must be an integer
        ]);

        // Get the filter values
        $dateStart = $request->input('date-start');
        $dateEnd = $request->input('date-end');
        $agentID = $request->input('agentID');
        $users = User::where('status', '1')->get();


        // Convert the date format from MM/DD/YYYY to YYYY-MM-DD
        if ($dateStart) {
            $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
        }

        if ($dateEnd) {
            $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
        }

        // dd($dateStart, $dateEnd);

        // Initialize the query
        $query = BuyRequest::query()
        ->join('users', 'buy_requests.agentID', '=', 'users.id')
        ->select('buy_requests.*',
            'buy_requests.created_at as buy_request_created_at',
            'buy_requests.updated_at as buy_request_updated_at',
            'users.name as agent_name')
        ->where('buy_requests.isActive', 1)
        ->orderBy('buy_requests.created_at', 'asc');


        // Apply date range filter
        if ($dateStart && $dateEnd) {
            $query->whereBetween('buy_requests.created_at', [
                Carbon::parse($dateStart)->startOfDay(),
                Carbon::parse($dateEnd)->endOfDay(),
            ]);
        }

        // Filter by agent ID if provided
        if ($agentID) {
            $query->where('agentID', $agentID);
        }

        // Execute the query and get the results
        $buyRequests = $query->paginate(10);

        // Return the results (e.g., to a view or as a JSON response)
        return view('admin.laporan.index', compact('buyRequests', 'users', 'dateStart', 'dateEnd', 'agentID'));
    }

    function viewExportToPDF(Request $request)
    {
        // @dd($request->all());
        // Validate the inputs
        $request->validate([
            'date-start' => 'nullable|date',
            'date-end' => 'nullable|date',
            'agentID' => 'nullable|integer', // Agent ID must be an integer
        ]);

        // Get the filter values
        $dateStart = $request->input('date-start');
        $dateEnd = $request->input('date-end');
        $agentID = $request->input('agentID');
        $users = User::where('status', '1')->get();


        // Convert the date format from MM/DD/YYYY to YYYY-MM-DD
        if ($dateStart) {
            try {
                $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
            } catch (\Exception $e) {
                // Fallback to handle if the date is already in 'Y-m-d' format
                $dateStart = Carbon::parse($dateStart)->format('Y-m-d');
            }
        }

        if ($dateEnd) {
            try {
                $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
            } catch (\Exception $e) {
                // Fallback to handle if the date is already in 'Y-m-d' format
                $dateEnd = Carbon::parse($dateEnd)->format('Y-m-d');
            }
        }


        // dd($dateStart, $dateEnd);

        // Initialize the query
        $query = BuyRequest::query()
        ->join('users', 'buy_requests.agentID', '=', 'users.id')
        ->select('buy_requests.*',
            'buy_requests.created_at as buy_request_created_at',
            'buy_requests.updated_at as buy_request_updated_at',
            'users.name as agent_name')
        ->where('buy_requests.isActive', 1)
        ->orderBy('buy_requests.created_at', 'asc');



        // Apply date range filter
        if ($dateStart && $dateEnd) {
            $query->whereBetween('buy_requests.created_at', [
                Carbon::parse($dateStart)->startOfDay(),
                Carbon::parse($dateEnd)->endOfDay(),
            ]);
        }

        // Filter by agent ID if provided
        if ($agentID) {
            $query->where('agentID', $agentID);
        }

        // Execute the query and get the results
        $buyRequests = $query->get();

        // @dd($buyRequests, $dateStart, $dateEnd, $agentID);

        $pdf = Pdf::loadView('pdf.template', compact('buyRequests', 'users', 'dateStart', 'dateEnd', 'agentID'));

        return $pdf->stream('Buy_Request_Form.pdf');
        // Return the results (e.g., to a view or as a JSON response)
        // return view('admin.laporan.index', compact('buyRequests', 'users'));
    }

    function exportToPDF(Request $request)
    {
        // @dd($request->all());
        // Validate the inputs
        $request->validate([
            'date-start' => 'nullable|date',
            'date-end' => 'nullable|date',
            'agentID' => 'nullable|integer', // Agent ID must be an integer
        ]);

        // Get the filter values
        $dateStart = $request->input('date-start');
        $dateEnd = $request->input('date-end');
        $agentID = $request->input('agentID');
        $users = User::where('status', '1')->get();


        // Convert the date format from MM/DD/YYYY to YYYY-MM-DD
        if ($dateStart) {
            try {
                $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
            } catch (\Exception $e) {
                // Fallback to handle if the date is already in 'Y-m-d' format
                $dateStart = Carbon::parse($dateStart)->format('Y-m-d');
            }
        }

        if ($dateEnd) {
            try {
                $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
            } catch (\Exception $e) {
                // Fallback to handle if the date is already in 'Y-m-d' format
                $dateEnd = Carbon::parse($dateEnd)->format('Y-m-d');
            }
        }


        // dd($dateStart, $dateEnd);

        // Initialize the query
        $query = BuyRequest::query()
        ->join('users', 'buy_requests.agentID', '=', 'users.id')
        ->select('buy_requests.*',
            'buy_requests.created_at as buy_request_created_at',
            'buy_requests.updated_at as buy_request_updated_at',
            'users.name as agent_name')
        ->where('buy_requests.isActive', 1)
        ->orderBy('buy_requests.created_at', 'asc');



        // Apply date range filter
        if ($dateStart && $dateEnd) {
            $query->whereBetween('buy_requests.created_at', [
                Carbon::parse($dateStart)->startOfDay(),
                Carbon::parse($dateEnd)->endOfDay(),
            ]);
        }

        // Filter by agent ID if provided
        if ($agentID) {
            $query->where('agentID', $agentID);
        }

        // Execute the query and get the results
        $buyRequests = $query->get();

        // @dd($buyRequests, $dateStart, $dateEnd, $agentID);

        $pdf = Pdf::loadView('pdf.template', compact('buyRequests', 'users', 'dateStart', 'dateEnd', 'agentID'));

        return $pdf->download('Buy_Request_Form.pdf');
        // Return the results (e.g., to a view or as a JSON response)
        // return view('admin.laporan.index', compact('buyRequests', 'users'));
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
