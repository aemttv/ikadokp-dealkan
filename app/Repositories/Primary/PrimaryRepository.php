<?php

namespace App\Repositories\Primary;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrimaryRepository implements PrimaryRepositoryInterface
{
    protected $baseUrl;
    protected $clientId;

    public function __construct()
    {
        $this->baseUrl = config('services.api_service.base_url');
        $this->clientId = config('services.api_service.client_id');
    }

    /**
     * get for primary properties (new properties).
     *
     * @param array $params Query parameters for the get (e.g., Keyword, Start, Count).
     * @return Collection The collection of properties returned from the API.
     */
    public function getPrimaryProperties(array $params): Collection
    {
        $cacheKey = 'primary_properties_' . md5(json_encode($params));
        $cacheTTL = now()->addMinutes(50); // Set cache TTL

        // Check if data is already in cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            // Try to fetch data from API
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchprimary', $params);

            // Check for successful response
            if ($response->successful()) {
                $properties = $response->json() ?? [];
                // Cache the result
                Cache::put($cacheKey, collect($properties), $cacheTTL);
            } else {
                // Log error for failed API response
                Log::error('API request failed with status: ' . $response->status());
                $properties = [];
            }
        } catch (ConnectionException $e) {
            // Handle connection issues
            Log::error('Connection exception: ' . $e->getMessage());
            $properties = $this->getCachedDataOrFallback($cacheKey);
        } catch (\Exception $e) {
            // Catch all other exceptions
            Log::error('General exception: ' . $e->getMessage());
            $properties = $this->getCachedDataOrFallback($cacheKey);
        }

        // Return the properties collection
        return collect($properties);
    }

    /**
     * Get primary property by slug.
     *
     * Fetch a primary property by its slug from the API.
     *
     * @return mixed The property data or null if not found.
     */
    public function getPrimaryPropertyBySlug(string $slug)
    {
        try {
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchprimary', [
                'Keyword' => $slug,
            ]);

            if ($response->successful()) {
                $property = $response->json();
                return $property ?: null;
            }
        } catch (Exception $e) {
            // Catch any exception and return null
            Log::error($e->getMessage());

            return null;
        }

        return null;
    }

    /**
     * Get properties based on direction or region.
     *
     * @param string $region The direction or region to filter properties.
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties matching the given direction or region.
     */
    public function getPrimaryPropertyByDirection(string $direction, int $start = 0, int $count = 12): Collection
    {
        try {
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchprimary', [
                'Start' => $start,
                'Count' => $count,
                'Wilayah' => $direction,
            ]);

            $properties = $response->json() ?? [];

            // Convert the properties array to a Collection
            return collect($properties);
        } catch (ConnectionException $e) {
            //
            Log::error($e->getMessage());
            // Handle connection exception or return empty collection
            return collect();
        }
    }

    /**
     * Fallback to cached data or return empty collection if no cache is available
     */
    protected function getCachedDataOrFallback(string $cacheKey): array
    {
        // If cache is available, return cached data
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Return empty array if no cache is available
        return [];
    }
}
