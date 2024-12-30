<?php

namespace App\Http\Controllers;

use App\Repositories\Secondary\SecondaryService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SecondaryController extends Controller
{
    //
    public function __construct(
        protected SecondaryService $secondaryService
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

    /**
     * Prepare filters for fetching secondary properties based on request parameters.
     *
     * This function generates an array of filters to be passed to the service for retrieving
     * secondary properties. It converts the transaction type from 'dijual' (sale) to 0 and anything
     * else (e.g., 'disewakan') to 1. Additionally, it handles pagination, listing status, and optional
     * search and filtering parameters such as price range and land/building size.
     *
     * @param Request $request The current HTTP request, containing potential filter values.
     * @param string $transactionType The type of transaction (e.g., 'dijual' for sale, or 'disewakan' for rent).
     * @param int $currentPage The current page number for paginated results.
     * @param int $perPage The number of results per page.
     * @return array|false An array containing filters and, if invalid, validation errors or `false` if no filters are valid.
     */
    private function prepareFilters(Request $request, string $transactionType, int $currentPage, int $perPage)
    {
        // Default filters setup
        $transactionType = $transactionType === 'dijual' ? 0 : 1;
        $filters = [
            'JualSewa' => $transactionType,
            'Start' => ($currentPage - 1) * $perPage,
            'Count' => $perPage,
            'StatusListing' => 1,
        ];

        // Validate request input
        $validation = Validator::make($request->all(), [
            'Pencarian' => 'nullable|string|max:255',
            'HargaTertinggi' => 'nullable|integer|min:0',
            'HargaTerendah' => 'nullable|integer|min:0',
            'LTMin' => 'nullable|integer|min:0',
            'LTMax' => 'nullable|integer|min:0',
            'LBMin' => 'nullable|integer|min:0',
            'LBMax' => 'nullable|integer|min:0',
            'Tipe' => 'nullable|integer|min:0',
        ]);

        if ($validation->fails()) {
            return [
                'filters' => [],
                'errors' => $validation->errors()->toArray()
            ];
        }

        // Process filterable parameters
        $filterableParams = [
            'Pencarian' => 'Keyword',
            'HargaTertinggi' => 'PriceRangeMax',
            'HargaTerendah' => 'PriceRangeMin',
            'LTMin' => 'LTMin',
            'LTMax' => 'LTMax',
            'LBMin' => 'LBMin',
            'LBMax' => 'LBMax',
            'Tipe' => 'TypeID',
        ];

        $hasFilter = false;

        foreach ($filterableParams as $param => $key) {
            if ($request->has($param)) {
                $value = $request->input($param);
                $filters[$key] = in_array($param, ['LTMin', 'LTMax', 'LBMin', 'LBMax']) ? intval($value) : $value;
                $hasFilter = true;
            }
        }

        // Return false if no valid filters are found
        if (!$hasFilter) {
            return false;
        }

        return ['filters' => $filters];
    }

    /**
     * Fetch properties based on transaction type and filters.
     *
     * This function prepares filters for retrieving secondary properties based on the transaction type
     * (e.g., sale, rent, etc.). It supports pagination and search functionality.
     *
     * @param Request $request The current HTTP request object, which may contain filters or search queries.
     * @param string $transactionType The type of transaction (e.g., 'sale', 'rent').
     * @param int $currentPage The current page number for paginated results.
     * @param int $perPage The number of items to retrieve per page.
     * @return Collection|false The collection of properties fetched from the service or `false` if no filters are valid.
     */
    private function fetchProperties(Request $request, string $transactionType, int $currentPage, int $perPage)
    {
        $filters = $this->prepareFilters($request, $transactionType, $currentPage, $perPage);

        if ($request->has('Pencarian') || $filters !== false) {

            if ($filters === false) {
                return false;
            }
            if ($filters['filters'] === []) {
                return false;
            }

            return $this->secondaryService->getSecondaryPropertiesBySearch(
                $filters['filters']
            );
        }

        return $this->secondaryService->getSecondaryProperties(
            $transactionType,
            ($currentPage - 1) * $perPage,
            $perPage
        );
    }

    /**
     * Check if the given API response is valid.
     *
     * @param array $response The API response to check.
     * @return bool True if the response is valid, false otherwise.
     */
    private function isValidResponse($response): bool
    {
        return isset($response['Status']) && $response['Status'] === 200;
    }


    public function index(Request $request, string $transactionType)
    {
        // Setup pagination parameters
        $currentPage = $request->input('page', 1);
        $perPage = 12;

        // Fetch properties based on the search or transaction type
        $response = $this->fetchProperties($request, $transactionType, $currentPage, $perPage);

        // Handle case where no valid filters are found
        if ($response === false) {
            return redirect()->back()->withErrors(['No valid filters provided.']);
        }

        // Guard clause to check for a successful response
        if (!$this->isValidResponse($response)) {
            $properties = [];
            return view('user.property.secondary', compact('properties'));
        }

        $properties = $response['Data']['Data'];
        $totalItems = $response['Data']['Count'];

        // Create pagination
        $properties = $this->createPaginator($properties, $totalItems, $perPage, $currentPage, $request);

        return view('user.property.secondary', compact('properties'));
    }


    public function show(String $slug)
    {
        // Get the primary property by slug
        $response = $this->secondaryService->getSecondaryBySlug($slug);

        // Return Data if found, otherwise return 404
        if (!$this->isValidResponse($response)) {
            abort(404);
        }

        $property = $response['Data']['Data'][0];

        $photosFromProperty = $property['Photo'] ?? [];
        $photosFromPhotos = $property['Photos'] ?? [];


        $agentSecondary = $property['Agent'];
        $photoforAgent = $agentSecondary['Photo'] ?? [];


        // Gabungkan kedua array
        $allPhotos = array_merge($photosFromProperty, $photosFromPhotos);
        $photoAgentSecondary = array_merge($photoforAgent);

        // Contact
        $agentName = $agentSecondary['Name'];
        $agentPhoneNumber = $agentSecondary['WhatsApp'];
        $formattedPhoneNumber = ltrim($agentPhoneNumber, '+');
        $propertyUrl = url("/property-baru/secondary/{$slug}");
        $message = urlencode("Halo " . $agentName . ", saya tertarik dan ingin tau lebih lanjut dengan properti ini: " . $propertyUrl);
        $whatsappLink = "https://wa.me/{$formattedPhoneNumber}?text={$message}";

        return view('user.property.detail', compact('property', 'allPhotos', 'photoAgentSecondary', 'whatsappLink'));
    }
}
