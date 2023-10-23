<?php

namespace App\Model;

use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;

class Tag
{
    #[Assert\NotBlank(message: 'The tag must have a slug.')]
    private string $slug;
    #[Assert\NotBlank(message: 'The tag must have a name.')]
    private string $name;
    #[Assert\NotBlank(message: 'The tag description cannot be an empty string.', allowNull: true)]
    private ?string $description = null;

    public static function slugify(string $text): string
    {
        $slugify = new Slugify();

        return $slugify->slugify(trim($text));
    }

    public static function mbFirstCaseUpper(string $text): string
    {
        $text = trim($text);
        if ('' === $text) {
            return $text;
        }

        $firstChar = mb_substr($text, 0, 1);
        $then = mb_substr($text, 1);

        return mb_strtoupper($firstChar) . $then;
    }

    public function __construct(?string $name = null, ?string $description = null)
    {
        $this->setName($name ?? '');

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

    public function setName(string $name): self
    {
        $this->name = static::mbFirstCaseUpper($name);
        $this->slug = static::slugify($this->name);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = null === $description ? null : $this->mbFirstCaseUpper($description);

        return $this;
    }
}
