<?php

namespace App\Http\Controllers;

use App\Models\BuyRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePdf(Request $request)
    {
        //Fetch data based on GET parameters
        $buyRequest = BuyRequest::join('users', 'buy_requests.agentID', '=', 'users.id')->
                where('isActive', '1')
                ->limit(5)->get();

        // Generate the PDF content
        $pdf = Pdf::loadView('pdf.template', compact('buyRequest'));

        // Return the PDF as a download
        return $pdf->stream('Buy_Request_Form.pdf');
        // return view('pdf.template');
    }
}

