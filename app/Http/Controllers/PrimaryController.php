<?php

namespace App\Http\Controllers;

use App\Repositories\Primary\PrimaryService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class PrimaryController extends Controller
{
    //
    public function __construct(
        protected PrimaryService $primaryService
    ) {}

    protected function createPaginator(array $items, int $totalItems, int $perPage, int $currentPage, Request $request): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $items,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

    public function index(Request $request)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'direction' => 'nullable|in:semua,timur,barat,selatan,utara',
            'page' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $direction = $request->input('direction', 'Semua');
        $page = $request->input('page', 1); // Menentukan halaman saat ini
        $perPage = 12; // Jumlah item per halaman

        $response = $this->primaryService->getPrimaryProperties([
            'Start' => ($page - 1) * $perPage,
            'Count' => $perPage,
        ]);

        $properties = $response['Data']['Data'] ?? []; // Menetapkan array kosong jika tidak ada data
        $totalItems = $response['Data']['Count'] ?? 0; // Menetapkan 0 jika tidak ada total item

        $properties = $this->createPaginator($properties, $totalItems, $perPage, $page, $request);


        return view('user.property.primary', compact('properties', 'direction'));
    }

    public function show(String $slug)
    {
        // Get the primary property by slug
        $response = $this->primaryService->getPrimaryPropertyBySlug($slug);

        // Return Data if found, otherwise return 404
        if (!$response) {
            abort(404);
        }

        $property = $response['Data']['Data'][0];

        $photosFromProperty = $property['Photo'] ?? [];
        $photosFromPhotos = $property['Photos'] ?? [];


        $agentPrimary = $property['Agents'][0] ?? [];
        $photoforAgent = $agentPrimary['Photo'] ?? [];


        // Gabungkan kedua array
        $allPhotos = array_merge($photosFromProperty, $photosFromPhotos);
        $photoAgentPrimary = array_merge($photoforAgent);

        // Contact
        $agentName = $agentPrimary['Name'];
        $agentPhoneNumber = $agentPrimary['WhatsApp'];
        $formattedPhoneNumber = ltrim($agentPhoneNumber, '+');
        $propertyUrl = $slug;
        $message = urlencode("Halo " . $agentName . ", saya tertarik dan ingin tau lebih lanjut dengan properti primary ini: " . $propertyUrl);
        $whatsappLink = "https://wa.me/{$formattedPhoneNumber}?text={$message}";

        return view('user.property.detail', compact('property', 'allPhotos', 'photoAgentPrimary', 'whatsappLink'));
    }


    public function getPropertyDirection(Request $request, $direction)
    {
        // Validator
        $validator = Validator::make($request->all(), [
            'direction' => 'nullable|in:semua,timur,barat,selatan,utara',
            'page' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $page = $request->input('page', 1); // Menentukan halaman saat ini
        $perPage = 12; // Jumlah item per halaman

        // Mendapatkan properti dari service dengan parameter pagination
        $response = $this->primaryService->getPrimaryPropertyByDirection($direction, ($page - 1) * $perPage, $perPage);
        // Menyusun data untuk pagination
        $properties = $response['Data']['Data'] ?? [];
        $totalItems = $response['Data']['Count'] ?? 0;

        $properties = $this->createPaginator($properties, $totalItems, $perPage, $page, $request);

        return view('user.property.primary', compact('properties', 'direction'));
    }
}
