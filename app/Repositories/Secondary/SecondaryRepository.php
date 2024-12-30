<?php

namespace App\Repositories\Secondary;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SecondaryRepository implements SecondaryRepositoryInterface
{
    protected $baseUrl;
    protected $clientId;

    public function __construct()
    {
        $this->baseUrl = config('services.api_service.base_url');
        $this->clientId = config('services.api_service.client_id');
    }


    /**
     * Get secondary properties from the API.
     *
     * @param string $transactionType Type of transaction (0: Sell, 1: Rent)
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties matching the given transaction type and pagination parameters.
     */
    public function getSecondaryProperties(string $transactionType, int $start = 0, int $count = 12): Collection
    {
        $cacheKey = 'secondary_properties_' . md5(json_encode($transactionType . $start . $count));
        $cacheTTL = now()->addMinutes(50); // Set cache TTL

        // Check if data is already in cache
        if (Cache::has($cacheKey)) {
            Log::info('Cache hit: ' . $cacheKey);
            return Cache::get($cacheKey);
        }

        $properties = []; // Inisialisasi $properties dengan array kosong

        try {
            // Try to fetch data from API
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchproperty', [
                'JualSewa' => $transactionType,
                'Start' => $start,
                'Count' => $count,
                // Find only active properties
                'StatusListing' => 1
            ]);

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


    public function getSecondaryPropertiesByDirection(int $direction, int $start = 0, int $count = 12): Collection
    {
        $cacheKey = 'secondary_properties_' . md5(json_encode($direction . $start . $count));
        $cacheTTL =  now()->addMinutes(4320); // Set cache TTL

        // Inisialisasi $properties dengan collection kosong
        $properties = collect();

        // Check if data is already in cache
        if (Cache::has($cacheKey)) {
            Log::info('Direction Cache hit: ' . $cacheKey);
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchproperty', [
                'HadapID' => $direction,
                'Start' => $start,
                'Count' => $count,
            ]);
            $properties = $response->json() ?? [];

            if ($response->successful()) {
                // Cache the result
                Cache::put($cacheKey, collect($properties), $cacheTTL);
            } else {
                // If API request fails, return empty collection
                $properties = collect();
            }
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
        }


        return collect($properties);
    }

    public function getSecondaryPropertiesBySearch(array $filters = [], int $start = 0, int $count = 12): Collection
    {
        // Inisialisasi $properties dengan collection kosong
        $properties = collect();

        try {
            // Menambahkan parameter 'Start' dan 'Count' ke dalam $filters
            $filters['Start'] = $start;
            $filters['Count'] = $count;

            // Mengambil data dari API
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchproperty', $filters);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $properties = collect($response->json() ?? []);
            } else {
                // Log kesalahan jika respons tidak berhasil
                Log::error('API request failed with status: ' . $response->status() . ' - ' . $response->body());
            }
        } catch (ConnectionException $e) {
            // Log jika ada kesalahan koneksi
            Log::error('Connection exception: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Log semua pengecualian lainnya
            Log::error('General exception: ' . $e->getMessage());
        }

        // Kembalikan koleksi properti
        return $properties;
    }


    /**
     * Get secondary property by slug.
     *
     * @param string $slug The slug of the property.
     * @return mixed The property data or null if not found.
     */
    public function getSecondaryPropertyBySlug(string $slug)
    {
        try {
            $response = Http::withHeaders([
                'ClientID' => $this->clientId,
            ])->get($this->baseUrl . 'api/property-api/searchproperty', [
                'URLSegment' => $slug,
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
