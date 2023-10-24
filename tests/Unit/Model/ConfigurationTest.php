<?php

namespace App\Tests\Unit\Model;

use App\Model\Configuration;
use App\Model\Directory;
use App\Tests\Traits\TempFoldersTrait;
use Exception;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use TempFoldersTrait;

    public function testAddDirectory(): void
    {
        $config = new Configuration();

        $this->assertEquals(0, count($config->getDirectories()));
        $folders = $this->generateTempFolders();

        $config->addDirectory(new Directory($folders[0]));
        $this->assertEquals(1, count($config->getDirectories()));

        $config->addDirectory(new Directory($folders[1]));
        $this->assertEquals(2, count($config->getDirectories()));

        $config->addDirectory(new Directory($folders[0]));
        $this->assertEquals(2, count($config->getDirectories()));

        $this->cleanTempFolders($folders);
    }

    public function testSetDirectories(): void
    {
        $config = new Configuration();

        $this->assertEquals(0, count($config->getDirectories()));
        $folders = $this->generateTempFolders();

        $temp = [];
        foreach ($folders as $folder) {
            $temp[] = new Directory($folder);
        }
        $config->setDirectories($temp);
        $this->assertEquals(3, count($config->getDirectories()));

        $this->cleanTempFolders($folders);
    }

    public function testGetDirectories(): void
    {
        $config = $this->generateConfiguration();
        $this->assertEquals(3, count($config->getDirectories()));
        $this->cleanConfiguration($config);
    }

    /**
     * @throws Exception
     */
    public function testGetDirectory(): void
    {
        $config = $this->generateConfiguration();

        $folder = $config->getDirectories()[1];
        $this->assertEquals($folder->getMd5(), $config->getDirectory(1)->getMd5());

        try {
            $config->getDirectory(20);
        } catch (Exception $ex) {
            $this->assertEquals(Exception::class, $ex::class);
        }

        $this->cleanConfiguration($config);
    }

    public function testRemoveDirectory(): void
    {
        $config = $this->generateConfiguration();
        $this->assertEquals(3, count($config->getDirectories()));

        $folder = $config->getDirectory(1);

        $config->removeDirectory($folder);
        $this->assertEquals(2, count($config->getDirectories()));

        $config->removeDirectory($folder);
        $this->assertEquals(2, count($config->getDirectories()));

        $this->cleanConfiguration($config);
    }

    public function testCount(): void
    {
        $config = $this->generateConfiguration();

        $this->assertEquals(3, count($config->getDirectories()));
        $this->assertEquals(3, $config->count());

        $this->cleanConfiguration($config);
    }

    public function testIndexOf(): void
    {
        $config = $this->generateConfiguration();

        $folder = $config->getDirectory(1);

        $index = -1;
        for ($a = 0; $a < $config->count(); ++$a) {
            if ($config->getDirectory($a)->getMd5() === $folder->getMd5()) {
                $index = $a;
            }
        }
        $this->assertEquals($index, $config->indexOf($folder));

        $this->cleanConfiguration($config);
    }

    /**
     * @throws Exception
     */
    public function testContains(): void
    {
        $config = $this->generateConfiguration();

        $folder = $config->getDirectory(1);
        $this->assertTrue($config->contains($folder));

        $this->cleanConfiguration($config);
    }
}
