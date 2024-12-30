<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Repositories\Primary\PrimaryService;
use App\Repositories\Secondary\SecondaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct(
        protected PrimaryService $primaryService,
        protected SecondaryService $secondaryService
    ) {}

    public function index()
    {
    // // Fetch primary properties
    // $primary = Property::limit(6)->get();
    // Log::info('Primary Properties:', $primary->toArray());

    // // Fetch secondary properties
    // $secondary = Property::limit(6)->get();
    // Log::info('Secondary Properties:', $secondary->toArray());

    // // Return the view with the data
    // return view('user.home', compact('primary', 'secondary'));
    }

    /**
     * Helper function to safely fetch properties with fallback and optional key extraction
     */
    // private function fetchPropertiesSafely(callable $callback, $default = [], $key = 'Data')
    // {
    //     try {
    //         $response = $callback();
    //         return $response[$key] ?? $default;
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return $default;
    //     }
    // }
}
