<?php
declare(strict_types=1);

namespace App\Domain\Product\Policy;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Specification\Specification;
use App\Domain\Product\Specification\TransparentBoxSpecification;
use App\Domain\Product\ValueObject\PolyMailer;

class PolyMailerPriceCalculationPolicy implements Policy
{
    private const BASE_PRICE_MULTIPLIER = 0.1;
    private const PRICE_MULTIPLIER_FOR_TRANSPARENT_BOX = 0.15;
    private Specification|TransparentBoxSpecification $specification;

    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function execute(Product $product): Product
    {
        /** @var PolyMailer $box */
        $box = $product->boxType();

        $multiplier = self::BASE_PRICE_MULTIPLIER;
        if ($this->specification->isSatisfiedBy($product)) {
            $multiplier += self::PRICE_MULTIPLIER_FOR_TRANSPARENT_BOX;
        }

        $price = ($box->width() + $box->height()) * $multiplier * $product->quantity();

        return new Product(
            $product->uuid(),
            $product->quantity(),
            $product->boxType(),
            $price
        );
    }
}
