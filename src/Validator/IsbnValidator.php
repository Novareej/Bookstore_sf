<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsbnValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\Isbn */

        if (null === $value || '' === $value) {
            return;
        }

        $value = (string) $value;
        $canonical = str_replace('-', '', $value);

        // Explicitly validate against ISBN-13
        if (Isbn::ISBN_13 === $constraint->type) {
            if (true !== ($code = $this->validateIsbn13($canonical))) {
                $this->context->buildViolation($this->getMessage($constraint, $constraint->type))
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode($code)
                    ->addViolation();
            }

            return;
        }

               $code = $this->validateIsbn13($canonical);
        
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }


 protected function validateIsbn13(string $isbn)
    {
        // Error priority:
        // 1. ERROR_INVALID_CHARACTERS
        // 2. ERROR_TOO_SHORT/ERROR_TOO_LONG
        // 3. ERROR_CHECKSUM_FAILED

        if (!ctype_digit($isbn)) {
            return Isbn::INVALID_CHARACTERS_ERROR;
        }

        $length = \strlen($isbn);

        if ($length < 13) {
            return Isbn::TOO_SHORT_ERROR;
        }

        if ($length > 13) {
            return Isbn::TOO_LONG_ERROR;
        }

        $checkSum = 0;

        for ($i = 0; $i < 13; $i += 2) {
            $checkSum += $isbn[$i];
        }

        for ($i = 1; $i < 12; $i += 2) {
            $checkSum += $isbn[$i] * 3;
        }

        return 0 === $checkSum % 10 ? true : Isbn::CHECKSUM_FAILED_ERROR;
    }
}