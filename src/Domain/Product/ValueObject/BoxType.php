<?php
declare(strict_types=1);

namespace App\Domain\Product\ValueObject;

interface BoxType
{
    public function key(): string;
}
