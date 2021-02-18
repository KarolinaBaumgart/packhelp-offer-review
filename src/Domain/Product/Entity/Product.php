<?php
declare(strict_types=1);

namespace App\Domain\Product\Entity;


use App\Domain\Product\ValueObject\BoxType;
use Symfony\Component\Validator\Constraints as Assert;

class Product
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     *
     * @Assert\Uuid()
     */
    private string $uuid;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min=50,
     *     max=2000
     * )
     */
    private int $quantity;

    /**
     * @ORM\Column(type="json")
     *
     * @Assert\Type(type={"MailerBox", "PolyMailer"})
     * @Assert\NotBlank()
     */
    private BoxType $boxType;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\Type('integer')
     * @Assert\NotBlank()
     */
    private int $price;

    public function __construct(string $uuid, int $quantity, BoxType $attribute, int $price)
    {
        $this->uuid = $uuid;
        $this->quantity = $quantity;
        $this->boxType = $attribute;
        $this->price = $price;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function boxType(): BoxType
    {
        return $this->boxType;
    }

    public function price(): int
    {
        return $this->price;
    }
}
