<?php

namespace App\Actions\Imports;

use App\Driver;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Drivers extends Import
{
    use AsAction;

    public string $commandSignature = 'imports:drivers';

    protected array $columnMapping = [
        'driverId' => 'id',
        'driverRef' => 'driver_ref',
        'forename' => 'given_name',
    ];

    protected string $table = 'drivers';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $file = $this->getFile();

        $headers = $this->parseHeaders(fgetcsv($file));
        $drivers = $this->combineData($file, $headers);

        Driver::truncate();

        $this->performImport($this->table, $drivers);
    }

    public function asCommand(Command $command): void
    {
        try {
            $this->handle();

            $command->info(ucfirst($this->table) . " imported");
        } catch (Exception $e) {
            $command->error($e->getMessage());
        }
    }
}
