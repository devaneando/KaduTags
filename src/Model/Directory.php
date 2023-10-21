<?php

namespace App\Model;

use App\Constraint as KaduAssert;
use Symfony\Component\Validator\Constraints as Assert;

class Directory
{
    #[Assert\NotBlank(message: 'The folder must have a MD5 hash.')]
    private string $md5;
    #[Assert\NotBlank(message: 'The folder must have a path.')]
    #[KaduAssert\Folder]
    private string $path;

    public function __construct(string $path = null)
    {
        if (null !== $path) {
            $this->setPath($path);
        }
    }

    public function getMd5(): string
    {
        return $this->md5;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = trim($path);
        $this->md5 = md5($this->path);
    }
}
