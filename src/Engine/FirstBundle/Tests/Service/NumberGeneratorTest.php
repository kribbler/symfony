<?php

namespace App\Engine\FirstBundle\Tests\Service;

use \Mockery\Adapter\Phpunit\MockeryTestCase;
use App\Engine\FirstBundle\Service\NumberGenerator;

class NumberGeneratorTest extends MockeryTestCase
{
    /** @var NumberGenerator */
    private $service;

    protected function setUp()
    {
        $this->service = new NumberGenerator();
    }

    public function testGetGeneratedNumber(): void
    {
        $result = $this->service->getGeneratedNumber();
        $this->assertInternalType('int', $result);
    }
}