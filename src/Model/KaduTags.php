<?php

namespace App\Model;

class KaduTags
{
    public const TYPE_TAGS = 'tags';
    public const TYPE_FILES = 'files';

    private array $tags;
    private array $files;
    private array $relations;

    public function __construct()
    {
        $this->tags = [];
        $this->files = [];
        $this->relations = [];
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags(array $tags): self
    {
        $this->tags = [];
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    public function addTag(Tag $tag): self
    {
        if ($this->contains($tag)) {
            return $this;
        }

        $this->tags[] = $tag;
        usort($this->tags, function (Tag $first, Tag $second) {
            return strcasecmp($first->getName(), $second->getName());
        });

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if (-1 === $index = $this->indexOf($tag)) {
            return $this;
        }

        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);

        return $this;
    }

    /**
     * @return File[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param File[] $files
     */
    public function setFiles(array $files): void
    {
        $this->files = $files;
    }

    public function addFile(File $file): self
    {
        if ($this->contains($file)) {
            return $this;
        }

        $this->files[] = $file;
        usort($this->files, function (File $first, File $second) {
            return strcasecmp($first->getMd5(), $second->getMd5());
        });

        return $this;
    }

    public function removeFile(File $file): self
    {
        if (-1 === $index = $this->indexOf($file)) {
            return $this;
        }

        unset($this->files[$index]);
        $this->files = array_values($this->files);

        return $this;
    }

    public function indexOf($object): int
    {
        $items = [];
        $method = null;
        if ($object instanceof Tag) {
            $items = $this->tags;
            $method = 'getSlug';
        } elseif ($object instanceof File) {
            $items = $this->files;
            $method = 'getMd5';
        }

        $count = count($items);
        if (null === $method || 0 === $count) {
            return -1;
        }

        for ($a = 0; $a < $count; ++$a) {
            $item = $items[$a];
            if ($item->$method() === $object->$method()) {
                return $a;
            }
        }

        return -1;
    }

    public function contains($object): int
    {
        return -1 !== $this->indexOf($object);
    }
}
