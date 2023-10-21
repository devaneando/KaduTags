<?php

namespace App\Tests\Unit\Model;

use App\Model\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testSetName(): void
    {
        $tag = new Tag('   é um lindo coração   ');
        $this->assertEquals('É um lindo coração', $tag->getName());
        $this->assertEquals('e-um-lindo-coracao', $tag->getSlug());
        $this->assertNull($tag->getDescription());
    }

    public function testSetDescription(): void
    {
        $tag = new Tag(null, 'é uma linda descrição!');
        $this->assertEquals('É uma linda descrição!', $tag->getDescription());
    }
}
