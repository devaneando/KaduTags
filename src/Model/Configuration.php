<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Configuration
{
    #[Assert\Valid()]
    /** @var Directory[] array */
    private array $directories;

    public function __construct()
    {
        $this->directories = [];
    }

    public function getDirectories(): array
    {
        return $this->directories;
    }

    /**
     * @throws \Exception
     */
    public function getDirectory(int $index): Directory
    {
        if (null === $directory = $this->directories[$index] ?? null) {
            throw new \Exception("No folder found with index #{$index}");
        }

        return $directory;
    }

    public function setDirectories(array $directories): self
    {
        foreach ($directories as $directory) {
            $this->addDirectory($directory);
        }

        return $this;
    }

    public function addDirectory(Directory $directory): self
    {
        if ($this->contains($directory)) {
            return $this;
        }

        $this->directories[] = $directory;
        $this->sort();

        return $this;
    }

    public function removeDirectory(Directory $directory): self
    {
        if (-1 === $index = $this->indexOf($directory)) {
            return $this;
        }

        unset($this->directories[$index]);
        $this->directories = array_values($this->directories);

        return $this;
    }

    public function count(): int
    {
        return count($this->directories);
    }

    public function indexOf(Directory $directory): int
    {
        if (0 === count($this->directories)) {
            return -1;
        }

        for ($a = 0; $a < count($this->directories); ++$a) {
            if ($this->directories[$a]->getMd5() === $directory->getMd5()) {
                return $a;
            }
        }

        return -1;
    }

    public function contains(Directory $directory): bool
    {
        return -1 !== $this->indexOf($directory);
    }

    private function sort(): void
    {
        usort($this->directories, function (Directory $first, Directory $second) {
            return strcasecmp($first->getPath(), $second->getPath());
        });
    }
}
