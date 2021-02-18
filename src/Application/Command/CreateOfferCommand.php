<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\ValueObject\Client;
use App\Domain\ValueObject\Products;
use App\Domain\ValueObject\Salesman;
use Ramsey\Uuid\UuidInterface;

class CreateOfferCommand
{
    private UuidInterface $uuid;
    private Salesman $salesman;
    private Client $client;
    private Products $products;

    public function __construct(UuidInterface $uuid, Salesman $salesman, Client $client, Products $products)
    {
        $this->uuid = $uuid;
        $this->salesman = $salesman;
        $this->client = $client;
        $this->products = $products;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function salesman(): Salesman
    {
        return $this->salesman;
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function products(): Products
    {
        return $this->products;
    }
}
