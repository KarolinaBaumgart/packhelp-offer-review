<?php
declare(strict_types=1);

namespace App\Domain\Product\Specification;

interface Specification
{
    public function isSatisfiedBy($product): bool;
}
