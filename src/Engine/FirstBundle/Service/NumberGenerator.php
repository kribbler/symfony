<?php
declare(strict_types=1);

namespace App\Engine\FirstBundle\Service;

class NumberGenerator
{
    public function getGeneratedNumber(): int
    {
        $number = random_int(0, 100);

        return $number;
    }
}