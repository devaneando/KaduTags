<?php

namespace App\Tests\Validation\Model;

use App\Model\File;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FileTest extends KernelTestCase
{
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
        $file = new File('first/second/third/lala.docx');
        $errors = $this->validator->validate($file);
        $this->assertEquals(0, $errors->count());
    }

    public function testEmpty(): void
    {
        $file = new File('');
        $errors = $this->validator->validate($file);
        $this->assertEquals(4, $errors->count());
        $this->assertEquals('The file must have a path.', $errors->get(0)->getMessage());
        $this->assertEquals('The file must have a basename.', $errors->get(1)->getMessage());
        $this->assertEquals('The file must have a extension.', $errors->get(2)->getMessage());
        $this->assertEquals('The file type is invalid.', $errors->get(3)->getMessage());
    }

    public function testInvalidPath(): void
    {
        $file = new File('/first/second/third');
        $errors = $this->validator->validate($file);

        $this->assertEquals(3, $errors->count());
        $this->assertEquals('The file path is invalid.', $errors->get(0)->getMessage());
        $this->assertEquals('The file must have a extension.', $errors->get(1)->getMessage());
        $this->assertEquals('The file type is invalid.', $errors->get(2)->getMessage());
    }
}
