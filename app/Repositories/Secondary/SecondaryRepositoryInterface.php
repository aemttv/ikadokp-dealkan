<?php

namespace App\Repositories\Secondary;

use Illuminate\Support\Collection;

interface SecondaryRepositoryInterface
{

    /**
     * Get secondary properties (resale properties) from API.
     *
     * @param int $transactionType The type of transaction (1 for sale, 2 for rent).
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties returned from the API.
     */

    public function getSecondaryProperties(string $transactionType, int $start = 0, int $count = 12): Collection;

    /**
     * Get secondary properties by direction.
     *
     * @param int $direction The direction of the property (1 barat, 4 selatan, 6 timur, 8 utara).
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties returned from the API.
     */

    public function getSecondaryPropertiesByDirection(int $direction, int $start = 0, int $count = 12): Collection;


    /**
     * Get secondary properties by search query.
     *
     * @param array $filters The filters for the search query (e.g. keyword, price range, etc).
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties returned from the API.
     */
    public function getSecondaryPropertiesBySearch(array $filters = [], int $start = 0, int $count = 12): Collection;

    /**
     * Get secondary property by slug.
     *
     * @param string $slug The slug of the property.
     * @return mixed The property data or null if not found.
     */
    public function getSecondaryPropertyBySlug(string $slug);
}
