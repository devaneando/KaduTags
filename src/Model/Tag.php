<?php

namespace App\Model;

use Cocur\Slugify\Slugify;

class Tag
{
    private string $slug;
    private string $name;
    private ?string $description = null;

    public function __construct(string $name = null, string $description = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }

        if (null !== $description) {
            $this->setDescription($description);
        }
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $this->mbFirstCaseUpper($name);

        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->name);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = null === $description ? null : $this->mbFirstCaseUpper($description);
    }

    private function mbFirstCaseUpper(string $text): string
    {
        $text = trim($text);
        if ('' === $text) {
            return $text;
        }

        $firstChar = mb_substr($text, 0, 1);
        $then = mb_substr($text, 1);

        return mb_strtoupper($firstChar) . $then;
    }
}