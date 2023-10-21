<?php

namespace App\Tests\validation\Model;

use App\Model\Directory;
use App\Tests\Traits\TempFoldersTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DirectoryTest extends KernelTestCase
{
    use TempFoldersTrait;

    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $container = static::getContainer();
        $this->validator = $container->get('validator');
    }

    public function testValid(): void
    {
        $folders = $this->generateTempFolders();
        $folder = $folders[0];
        $directory = new Directory($folder);
        $errors = $this->validator->validate($directory);
        $this->assertEquals(0, $errors->count());
        $this->cleanTempFolders($folders);
    }

    public function testEmpty(): void
    {
        $directory = new Directory();
        $errors = $this->validator->validate($directory);
        $this->assertEquals(2, $errors->count());
        $this->assertEquals('The folder must have a MD5 hash.', $errors->get(0)->getMessage());
        $this->assertEquals('The folder must have a path.', $errors->get(1)->getMessage());
    }

    public function testNotExistentFolder(): void
    {
        $directory = new Directory();
        $directory->setPath('lala');
        $errors = $this->validator->validate($directory);
        $this->assertEquals(2, $errors->count());
        $this->assertEquals('The folder lala do not exist.', $errors->get(0)->getMessage());
        $this->assertEquals('"lala" is not a folder.', $errors->get(1)->getMessage());
    }

    public function testFolderIsFile(): void
    {
        $files = $this->generateTempFiles();
        $file = $files[0];

        $directory = new Directory();
        $directory->setPath($file);
        $errors = $this->validator->validate($directory);
        $this->assertEquals(1, $errors->count());
        $this->assertEquals("\"{$file}\" is not a folder.", $errors->get(0)->getMessage());
        $this->cleanTempFiles($files);
    }
}
