<?php

namespace App\Actions\Imports;

use App\Models\Laptime;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Laptimes
{
    use AsAction;

    public string $commandSignature = 'imports:laptimes';

    protected array $columnMapping = [
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
    ];

    protected string $table = 'laptimes';
    protected string $fileName = 'lap_times';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Laptime::truncate();
        (new Import())->handle($this->table, $this->columnMapping, $this->fileName);
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
