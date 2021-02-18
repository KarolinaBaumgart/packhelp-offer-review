<?php
declare(strict_types=1);

namespace App\Domain\Offer;

use App\Domain\ValueObject\Client;
use App\Domain\ValueObject\Products;
use App\Domain\ValueObject\Salesman;

class Offer
{
    private string $uuid;
    private ?Client $client;
    private ?Products $products;
    private ?Salesman $salesman;
    private ?int $price;
    private \DateTime $createTime;

    public function __construct(string $uuid, Client $client, Products $products, Salesman $salesman, ?int $price = null)
    {
        $this->uuid = $uuid;
        $this->client = $client;
        $this->products = $products;
        $this->salesman = $salesman;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Client
     */
    public function client(): Client
    {
        return $this->client;
    }

    /**
     * @return Products
     */
    public function products(): Products
    {
        return $this->products;
    }

    /**
     * @return Salesman
     */
    public function salesman(): Salesman
    {
        return $this->salesman;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function createTime(): \DateTime
    {
        return $this->createTime;
    }

}
