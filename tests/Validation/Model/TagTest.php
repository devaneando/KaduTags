<?php

namespace App\Tests\Validation\Model;

use App\Model\Tag;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TagTest extends KernelTestCase
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
        $tag = new Tag('This is a tag');
        $errors = $this->validator->validate($tag);
        $this->assertEquals(0, $errors->count());
    }

    public function testEmptyName(): void
    {
        $tag = new Tag('');
        $errors = $this->validator->validate($tag);
        $this->assertEquals(2, $errors->count());
        $this->assertEquals('The tag must have a slug.', $errors->get(0)->getMessage());
        $this->assertEquals('The tag must have a name.', $errors->get(1)->getMessage());
    }

    public function testEmptyDescription(): void
    {
        $tag = new Tag('This is a tag', '');
        $errors = $this->validator->validate($tag);
        $this->assertEquals(1, $errors->count());
        $this->assertEquals('The tag description cannot be an empty string.', $errors->get(0)->getMessage());
    }
}
