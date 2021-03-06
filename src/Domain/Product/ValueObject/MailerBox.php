<?php
declare(strict_types=1);

namespace App\Domain\Product\ValueObject;

class MailerBox implements BoxType
{
    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\Type('integer')
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min=1,
     *     max=200
     * )
     */
    private int $width;
    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\Type('integer')
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min=1,
     *     max=200
     * )
     */
    private int $height;
    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\Type('integer')
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min=1,
     *     max=200
     * )
     */
    private int $length;

    public function __construct(int $width, int $height, int $length)
    {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    public function key():string
    {

    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function length(): int
    {
        return $this->length;
    }
}
