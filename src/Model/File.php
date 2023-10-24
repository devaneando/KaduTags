<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class File
{
    public static function getExtensions(): array
    {
        return [
            'doc',
            'docx',
            'odt',
            'pdf',
            'ppt',
            'pptx',
            'txt',
            'xls',
            'xlsx',
        ];
    }

    #[Assert\NotBlank(message: 'The file must have a MD5 hash.')]
    private string $md5;
    #[Assert\NotBlank(message: 'The file must have a path.')]
    #[Assert\Regex('/^[^\/](.*)\/(.*)[^\/]$/', message: 'The file path is invalid.')]
    private string $path;
    #[Assert\NotBlank(message: 'The file must have a basename.')]
    private string $basename;
    #[Assert\NotBlank(message: 'The file must have a extension.')]
    #[Assert\Choice(callback: 'getExtensions', message: 'The file type is invalid.')]
    private string $extension;

    public function __construct(string $path = null)
    {
        $this->setPath($path ?? '');
    }

    public function getMd5(): string
    {
        return $this->md5;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $info = pathinfo(trim($path));

        $this->path = $info['dirname'] ?? '';
        $this->basename = $info['basename'] ?? '';
        $this->extension = $info['extension'] ?? '';
        $this->md5 = md5($this->getFilename());

        return $this;
    }

    public function getBasename(): string
    {
        return $this->basename;
    }

    public function setBasename(string $basename): void
    {
        $this->basename = $basename;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function getFilename(): string
    {
        return $this->path . DIRECTORY_SEPARATOR . $this->basename;
    }
}
