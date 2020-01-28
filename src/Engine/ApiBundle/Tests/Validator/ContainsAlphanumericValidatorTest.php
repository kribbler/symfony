<?php
declare (strict_types=1);

namespace App\Engine\ApiBundle\Tests\Validator;

use App\Engine\ApiBundle\Validator\Constraints\ContainsAlphanumericValidator;
use App\Engine\ApiBundle\Validator\Constraints\ContainsAlphanumeric;
use Mockery as m;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class ContainsAlphanumericValidatorTest extends \PHPUnit\Framework\TestCase
{
    use m\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @var ContainsAlphanumericValidator */
    private $validator;

    /** @var ContainsAlphanumeric */
    private $constraint;

    /** @var ConstraintViolationBuilderInterface */
    private $constraintViolationBuilder;

    protected function setUp()
    {
        $this->context = m::mock(ExecutionContextInterface::class);
        $this->constraint = new ContainsAlphanumeric();
        $this->validator = new ContainsAlphanumericValidator();
        $this->constraintViolationBuilder = m::mock(ConstraintViolationBuilderInterface::class);

        $this->validator->initialize($this->context);
    }

    public function testIsValidator(): void
    {
        $this->assertInstanceOf(ContainsAlphanumericValidator::class, $this->validator);
    }

    public function testNullPasses(): void
    {
        $response = $this->validator->validate(null, $this->constraint);
        $this->assertNull($response);
    }

    public function testNumberOnlyPasses(): void
    {
        $this->expectException(ValidatorException::class);

        $response = $this->validator->validate(111, $this->constraint);
    }

    public function testWrongStringFormatPasses(): void
    {
        $this->context
            ->shouldReceive('buildViolation')
            ->once()
            ->andReturn($this->constraintViolationBuilder);

        $this->constraintViolationBuilder
            ->shouldReceive('setParameter')
            ->once()
            ->andReturn($this->constraintViolationBuilder);
        
        $this->constraintViolationBuilder
            ->shouldReceive('addViolation')
            ->once();

        $response = $this->validator->validate('1-a-1', $this->constraint);
    }
}