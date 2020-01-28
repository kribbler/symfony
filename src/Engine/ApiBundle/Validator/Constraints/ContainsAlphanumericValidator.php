<?php
declare(strict_types=1);

namespace App\Engine\ApiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\ValidatorException;

class ContainsAlphanumericValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsAlphanumeric) {
            throw new ValidatorException(spintf('Wrong class %s', ContainsAlphanumeric::class));
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new ValidatorException(sprintf('Wrong value %s', $value));
        }

        if (!preg_match('/^[0-9]-[0-9]+$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
