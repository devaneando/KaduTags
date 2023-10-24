<?php

namespace App\Manager;

use App\Model\Configuration;
use App\Model\Directory;
use App\Model\File;
use App\Model\KaduTags;
use Exception;
use Symfony\Component\Finder\Finder;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TagManager
{
    public const FILE = '.kaduTags';

    private Configuration $configuration;

    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * @throws Exception
     */
    public function addDirectory(string $path, bool $includeFiles = false, bool $force = false): bool
    {
        $path = trim($path);

        if ('' === $path) {
            throw new Exception('The directory must not be empty!');
        }

        if (DIRECTORY_SEPARATOR === $path) {
            throw new Exception('Root folder not allowed!');
        }

        if ($_SERVER['HOME'] === $path = realpath($path)) {
            throw new Exception('Home folder not allowed!');
        }

        $count = $this->configuration->count();
        $directory = new Directory($path);
        $this->configuration->addDirectory($directory);
        $this->saveConfig();
        $wasOk = $count !== $this->configuration->count();
        if ($force && $this->configuration->contains($directory)) {
            $wasOk = true;
        }

        if ($wasOk && ($includeFiles || $force)) {
            $this->includeFiles($path);
        }

        return false;
    }

    private function includeFiles(string $path): void
    {
        $kadu = $this->loadTags($path);
        $files = $this->find($path);
        foreach ($files as $file) {
            $tempPath = str_replace($path, '', $file->getPathname());
            $kadu->addFile(new File(trim($tempPath, DIRECTORY_SEPARATOR)));
        }
        $this->saveTags($path, $kadu);
    }

    private function loadConfig(): void
    {
        $file = $_SERVER['HOME'] . DIRECTORY_SEPARATOR . static::FILE;
        if (!file_exists($file)) {
            $this->configuration = new Configuration();
            $this->saveConfig();
        }

        $this->configuration = $this->deserialize(file_get_contents($file), Configuration::class);
    }

    private function saveConfig(): void
    {
        $file = $_SERVER['HOME'] . DIRECTORY_SEPARATOR . static::FILE;
        file_put_contents($file, $this->serialize($this->configuration));
    }

    private function loadTags(string $directory): KaduTags
    {
        $file = $directory . DIRECTORY_SEPARATOR . static::FILE;
        if (!file_exists($file)) {
            $this->saveTags($directory, new KaduTags());
        }

        return $this->deserialize(file_get_contents($file), KaduTags::class);
    }

    private function saveTags(string $directory, KaduTags $tags): void
    {
        $file = $directory . DIRECTORY_SEPARATOR . static::FILE;
        file_put_contents($file, $this->serialize($tags));
    }

    private function serialize($object): string
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize(
            $object,
            'json',
            ['json_encode_options' => JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE]
        );
    }

    private function deserialize(string $json, string $class): mixed
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(null, null, null, new ReflectionExtractor()),
        ];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->deserialize($json, $class, 'json');
    }

    private function find(string $directory): Finder
    {
        $extensions = [];
        foreach (File::getExtensions() as $extension) {
            $extensions[] = '*.' . $extension;
        }

        $finder = new Finder();

        return $finder
            ->files()
            ->in($directory)
            ->name($extensions)
            ->sortByName();
    }
}
