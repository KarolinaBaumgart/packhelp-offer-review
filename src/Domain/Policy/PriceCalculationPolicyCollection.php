<?php
declare(strict_types=1);

namespace App\Domain\Policy;

class PriceCalculationPolicyCollection
{
    private array $policies;

    public function __construct(\Traversable $policies)
    {
        $this->policies = iterator_to_array($policies);
    }

    public function get(string $productBoxType){
        return $this->policies[$productBoxType];
    }
}
