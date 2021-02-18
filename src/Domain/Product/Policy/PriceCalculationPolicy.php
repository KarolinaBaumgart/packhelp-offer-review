<?php
declare(strict_types=1);

namespace App\Domain\Product\Policy;

use App\Domain\Product\Product;

interface PriceCalculationPolicy
{
    public function execute(Product $product): Product;
}
