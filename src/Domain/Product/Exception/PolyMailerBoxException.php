<?php
declare(strict_types=1);

namespace App\Domain\Product\Exception;

class PolyMailerBoxException extends \RuntimeException
{
    public static function fromBoxType(): self{
        return new self(sprintf("Box is not poly mailer."));
    }
}
