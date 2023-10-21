<?php

namespace App\Constraint;

use App\Constraint\Validator\FolderValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Folder extends Constraint
{
    public string $messageNotExistentFolder = 'The folder {{ string }} do not exist.';
    public string $messageIsNotFolder = '"{{ string }}" is not a folder.';

    // all configurable options must be passed to the constructor
    public function __construct(
        string $messageNotExistentFolder = null,
        string $messageIsNotFolder = null,
        array $groups = null,
        $payload = null
    ) {
        parent::__construct([], $groups, $payload);

        $this->messageNotExistentFolder = $messageNotExistentFolder ?? $this->messageNotExistentFolder;
        $this->messageIsNotFolder = $messageIsNotFolder ?? $this->messageIsNotFolder;
    }

    public function validatedBy(): string
    {
        return FolderValidator::class;
    }
}
