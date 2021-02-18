<?php
declare(strict_types=1);

namespace App\Domain\Policy;

use App\Domain\Offer\Offer;
use App\Domain\Product\Product;

class CalculateOfferPricePolicy
{
    private PriceCalculationPolicyCollection $policies;

    public function __construct(PriceCalculationPolicyCollection $policies)
    {
        $this->policies = $policies;
    }

    public function execute(Offer $offer)
    {
        $offerPrice = 0;

        /** @var Product $product */
        foreach ($offer->products() as $product) {
            $box = $product->boxType();
            $policy = $this->policies->get($box->key());

            $product = $policy->execute($product);

            $offerPrice += $product->price();
        }

        return new Offer(
            $offer->uuid(),
            $offer->client(),
            $offer->products(),
            $offer->salesman(),
            $offerPrice
        );
    }
}
