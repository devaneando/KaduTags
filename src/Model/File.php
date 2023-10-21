<?php

namespace App\Model;

class File
{
    private string $md5;
    private string $path;
    private string $basename;
    private string $extension;

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

        $this->path = $info['dirname'];
        $this->basename = $info['basename'];
        $this->extension = $info['extension'];
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
