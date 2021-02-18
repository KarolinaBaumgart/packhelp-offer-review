<?php
declare(strict_types=1);

namespace App\Application\Command\Handler;

use App\Application\Command\CreateOfferCommand;
use App\Domain\Offer\Offer;
use App\Domain\Service\OfferService;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateOfferCommandHandler
{
    private OfferService $offerService;
    private ValidatorInterface $validator;

    public function __construct(
        OfferService $offerService,
        ValidatorInterface $validator
    )
    {
        $this->offerService = $offerService;
        $this->validator = $validator;
    }

    public function __invoke(CreateOfferCommand $command)
    {
        $product = new Offer(
            (string)$command->uuid(),
            $command->client(),
            $command->products(),
            $command->salesman(),
        );

        $errors = $this->validator->validate($product);

        if ($errors->count()) {
            throw new ValidatorException((string)$errors);
        }

    }
}
