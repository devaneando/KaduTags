<?php

namespace App\Tests\Unit\Model;

use App\Model\File;
use App\Tests\Traits\TempFoldersTrait;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    use TempFoldersTrait;

    public function testLals(): void
    {
        $tempFile = 'first' . DIRECTORY_SEPARATOR
            . 'second' . DIRECTORY_SEPARATOR
            . 'third' . DIRECTORY_SEPARATOR
            . 'myFile.docx';

        $file = new File();
        $file->setPath($tempFile);

        $this->assertEquals('first/second/third', $file->getPath());
        $this->assertEquals('9919d05492f2ed8d32f6d6823c31af2a', $file->getMd5());
        $this->assertEquals('myFile.docx', $file->getBasename());
        $this->assertEquals('docx', $file->getExtension());
    }
}
