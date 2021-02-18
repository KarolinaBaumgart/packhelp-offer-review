<?php
declare(strict_types=1);

namespace App\Domain\Product\Policy;

use App\Domain\Product\Entity\Product;

interface Policy
{
    public function execute(Product $product): Product;
}
