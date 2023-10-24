<?php

namespace App\Tests\Unit\Model;

use App\Model\File;
use App\Model\KaduTags;
use App\Model\Tag;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class KaduTagTest extends TestCase
{
    public function testAddTags(): void
    {
        $kadu = new KaduTags();
        $this->assertCount(0, $kadu->getTags());
        $tags = $this->getTags(5);
        foreach ($tags as $tag) {
            $kadu->addTag($tag);
        }
        $this->assertCount(5, $kadu->getTags());

        $kadu->addTag($tags[3]);
        $this->assertCount(5, $kadu->getTags());
    }

    public function testSetTags(): void
    {
        $kadu = new KaduTags();
        $this->assertCount(0, $kadu->getTags());
        $kadu->setTags($this->getTags(5));
        $this->assertCount(5, $kadu->getTags());
    }

    public function testRemoveTags(): void
    {
        $kadu = new KaduTags();
        $tags = $this->getTags(5);
        $kadu->setTags($tags);
        $this->assertCount(5, $kadu->getTags());

        $kadu->removeTag($tags[3]);
        $this->assertCount(4, $kadu->getTags());

        $otherTags = $this->getTags(1);
        $kadu->removeTag($otherTags[0]);
        $this->assertCount(4, $kadu->getTags());
    }

    private function getTags(int $howMany = 3): array
    {
        $faker = Factory::create('pt_PT');
        $tags = [];
        for ($a = 0; $a < $howMany; ++$a) {
            $tag = new Tag();
            $tag
                ->setName($faker->firstName . ' ' . $faker->lastName)
                ->setDescription($faker->realText());
            $tags[] = $tag;
        }

        return $tags;
    }

    public function testAddFiles(): void
    {
        $kadu = new KaduTags();
        $this->assertCount(0, $kadu->getFiles());
        $files = $this->getFiles(5);
        foreach ($files as $file) {
            $kadu->addFile($file);
        }
        $this->assertCount(5, $kadu->getFiles());

        $kadu->addFile($files[3]);
        $this->assertCount(5, $kadu->getFiles());
    }

    public function testSetFiles(): void
    {
        $kadu = new KaduTags();

        $this->assertCount(0, $kadu->getFiles());
        $kadu->setFiles($this->getFiles(5));
        $this->assertCount(5, $kadu->getFiles());
    }

    public function testRemoveFiles(): void
    {
        $kadu = new KaduTags();

        $this->assertCount(0, $kadu->getFiles());
        $files = $this->getFiles(5);
        $kadu->setFiles($files);
        $this->assertCount(5, $kadu->getFiles());
        $kadu->removeFile($files[3]);
        $this->assertCount(4, $kadu->getFiles());
        $kadu->removeFile($files[3]);
        $this->assertCount(4, $kadu->getFiles());
    }

    private function getFiles(int $howMany = 3): array
    {
        $faker = Factory::create();
        $files = [];
        for ($a = 0; $a < $howMany; ++$a) {
            $path = 'first' . DIRECTORY_SEPARATOR . 'second' . DIRECTORY_SEPARATOR . 'third';
            if (0 === rand(0, 1)) {
                $path = 'first' . DIRECTORY_SEPARATOR . 'second';
            } elseif (0 === rand(0, 1)) {
                $path = 'first';
            }
            $index = rand(0, count(File::getExtensions()) - 1);
            $path .= DIRECTORY_SEPARATOR . $faker->lastName . '.' . File::getExtensions()[$index];
            $files[] = new File($path);
        }

        return $files;
    }
}
