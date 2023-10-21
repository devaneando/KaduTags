<?php

namespace App\Tests\Traits;

trait TempFoldersTrait
{
    private function generateTempFolders(): array
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

    private function cleanTempFolders(array $folders): void
    {
        foreach ($folders as $folder) {
            if (file_exists($folder)) {
                rmdir($folder);
            }
        }
    }

    private function generateTempFiles(): array
    {
        $tempDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'kaduTags';
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }

        $files = [];
        for ($a = 0; $a < 3; ++$a) {
            $file = tempnam($tempDir, 'kadu_') . '.dat';
            file_put_contents($file, "This is in empty file.\n");
            $files[] = $file;
        }

        return $files;
    }

    private function cleanTempFiles(array $files): void
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
