<?php
declare(strict_types=1);

namespace App\Domain\Product\Specification;

use App\Domain\Product\Exception\PolyMailerBoxException;
use App\Domain\Product\ValueObject\PolyMailer;

class TransparentBoxSpecification implements Specification
{
    public const MATERIAL_TYPE = 'transparent';

    public function isSatisfiedBy($product): bool
    {
        /** @var PolyMailer $box */
        $box = $product->boxType();

        if(!$box instanceof PolyMailer){
            throw PolyMailerBoxException::fromBoxType();
        }

        return $box->material() === self::MATERIAL_TYPE;
    }
}
