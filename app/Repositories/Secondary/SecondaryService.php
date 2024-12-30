<?php

namespace App\Repositories\Secondary;

use Illuminate\Support\Collection;

class SecondaryService
{
    protected $propertyRepository;

    public function __construct(SecondaryRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    // Function to convert transactionType to type
    private function convertTransactionTypeToType(string $transactionType): int
    {
        return match ($transactionType) {
            'disewa' => 1,
            'dijual' => 0,
            default => throw new \InvalidArgumentException("Invalid transaction type: $transactionType"),
        };
    }

    public function getSecondaryProperties(string $transactionType, int $start = 0, int $count = 12): Collection
    {
        // Convert transactionType to type
        $transactionType = $this->convertTransactionTypeToType($transactionType);
        return $this->propertyRepository->getSecondaryProperties($transactionType, $start, $count);
    }

    public function getSecondaryPropertiesBySearch(array $filters, int $start = 0, int $count = 12): Collection
    {
        return $this->propertyRepository->getSecondaryPropertiesBySearch($filters, $start, $count);
    }

    public function getSecondaryPropertiesByDirection(int $direction, int $start = 0, int $count = 12): Collection
    {
        return $this->propertyRepository->getSecondaryPropertiesByDirection($direction, $start, $count);
    }

    public function getSecondaryBySlug(string $slug)
    {
        return $this->propertyRepository->getSecondaryPropertyBySlug($slug);
    }
}
