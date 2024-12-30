<?php

namespace App\Repositories\Primary;

use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\String_;

interface PrimaryRepositoryInterface
{
    /**
     * get for primary properties (new properties).
     *
     * @param array $params Query parameters for the get (e.g., Keyword, Start, Count).
     * @return Collection The collection of properties returned from the API.
     */
    public function getPrimaryProperties(array $params): Collection;

    /**
     * Get primary property by slug.
     *
     * @param string $slug The slug of the property.
     * @return mixed The property data or null if not found.
     */
    public function getPrimaryPropertyBySlug(string $slug);

    /**
     * Get properties based on direction or region.
     *
     * @param string $region The direction or region to filter properties.
     * @param int $start The start index of the properties to return.
     * @param int $count The number of properties to return.
     * @return Collection The collection of properties matching the given direction or region.
     */

    public function getPrimaryPropertyByDirection(string $direction,  int $start = 0, int $count = 12): Collection;



}
