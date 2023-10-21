<?php

namespace App\Constraint\Validator;

use App\Constraint\Folder;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class FolderValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Folder) {
            throw new UnexpectedTypeException($constraint, Folder::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (false === $folder = realpath(trim($value))) {
            $this->context->buildViolation($constraint->messageNotExistentFolder)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (!is_dir($folder)) {
            $this->context->buildViolation($constraint->messageIsNotFolder)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
