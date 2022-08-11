<?php

namespace App\Actions\Imports;

use Exception;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;
use ZipArchive;

class DownloadFiles
{
    use AsAction;

    private const ERGAST_ZIP_FILE_URL = 'https://ergast.com/downloads/f1db_csv.zip';

    public string $commandSignature = 'imports:download';

    private string $zipPath = '';

    private ZipArchive $zipArchive;

    /**
     * @throws Exception
     */
    private function handle(): void
    {
        $this->zipPath = storage_path('app/imports/temp.zip');

        $this->downloadZipFile();
        $this->extractZipContents();
        $this->deleteZipArchive();
    }

    /**
     * @throws Exception
     */
    private function downloadZipFile(): void
    {
        $file = file_put_contents($this->zipPath, fopen(self::ERGAST_ZIP_FILE_URL, 'r'), LOCK_EX);

        if (!$file) {
            throw new Exception("Couldn't download ZIP archive");
        }
    }

    /**
     * @throws Exception
     */
    private function extractZipContents(): void
    {
        $this->zipArchive = new ZipArchive;
        $res = $this->zipArchive->open($this->zipPath);

        if (!$res) {
            throw new Exception("Couldn't open ZIP archive");
        }

        $this->zipArchive->extractTo(storage_path('app/imports'));
    }

    private function deleteZipArchive(): void
    {
        $this->zipArchive->close();
        unlink($this->zipPath);
    }

    public function asCommand(Command $command): void
    {
        try {
            $this->handle();

            $command->info("ZIP downloaded and extracted");
        } catch (Exception $e) {
            $command->error($e->getMessage());
        }
    }
}
