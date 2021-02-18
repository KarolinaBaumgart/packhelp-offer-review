<?php
declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Offer\Offer;
use App\Domain\Offer\OfferRepository;
use App\Domain\Policy\CalculateOfferPricePolicy;

class OfferService
{
    private CalculateOfferPricePolicy $policy;
    private OfferRepository $offerRepository;

    public function __construct(
        CalculateOfferPricePolicy $policy,
        OfferRepository $offerRepository
    )
    {
        $this->policy = $policy;
        $this->offerRepository = $offerRepository;
    }

    public function prepareOffer(Offer $offer)
    {
        /**
         * check if client and salesman exist in system
         */

        $offer = $this->policy->execute($offer);

        $this->offerRepository->save($offer);
    }
}
