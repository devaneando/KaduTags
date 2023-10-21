<?php

namespace App\Tests\unit\Model;

use App\Model\Directory;
use PHPUnit\Framework\TestCase;

class DirectoryTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testSetPath(): void
    {
        $directory = new Directory();
        $directory->setPath('     lala    ');
        $this->assertEquals('lala', $directory->getPath());
        $this->assertEquals(md5('lala'), $directory->getMd5());
    }

    private function generateFolders(): array
    {
        $tempDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'kaduTags';
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }

        $directories = [];
        for ($a = 1; $a < 4; ++$a) {
            $folder = uniqid($tempDir . DIRECTORY_SEPARATOR);
            if (!file_exists($folder)) {
                mkdir($folder);
            }
            $directories[] = $folder;
        }

        return $directories;
    }

    private function cleanFolders(array $folders): void
    {
        foreach ($folders as $folder) {
            if (file_exists($folder)) {
                rmdir($folder);
            }
        }
    }
}
