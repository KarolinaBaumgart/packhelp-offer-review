<?php
declare(strict_types=1);

namespace App\Application;

use App\Application\Command\CreateOfferCommand;
use App\Application\Form\OfferType;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;

#[Route('offers')]
class OfferController extends AbstractController
{
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request, MessageBusInterface $commandBus): JsonResponse
    {
        try {
            $form = $this->createForm(OfferType::class);
            $data = json_decode($request->getContent(), true);
            $form->submit($data);

            if (!$form->isSubmitted()) {
                throw new RuntimeException("Form not submitted");
            }

            if (!$form->isValid()) {
                throw new ValidatorException((string)$form->getErrors(true, false));
            }

            $offerData = $form->getData();

            $offerId = Uuid::uuid1();

            $commandBus->dispatch(new CreateOfferCommand(
                $offerId,
                $offerData['salesman'],
                $offerData['client'],
                $offerData['products']
            ));

            return new JsonResponse([
                'offer_id' => $offerId
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
