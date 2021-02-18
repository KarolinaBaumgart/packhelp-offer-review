<?php
declare(strict_types=1);

namespace App\Domain\Product\Policy;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\ValueObject\MailerBox;

class MailerBoxPriceCalculationPolicy implements Policy
{
    private const BASE_PRICE_MULTIPLIER = 0.1;

    public function execute(Product $product): Product
    {
        /** @var MailerBox $box */
        $box = $product->boxType();

        $price = ($box->width() + $box->height() + $box->length())
            * self::BASE_PRICE_MULTIPLIER
            * $product->quantity();

        return new Product(
            $product->uuid(),
            $product->quantity(),
            $product->boxType(),
            $price
        );
    }
}
