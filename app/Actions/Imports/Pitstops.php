<?php

namespace App\Actions\Imports;

use App\Models\Pitstop;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Pitstops
{
    use AsAction;

    public string $commandSignature = 'imports:pitstops';

    protected array $columnMapping = [
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
    ];

    protected string $table = 'pitstops';
    protected string $fileName = 'pit_stops';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Pitstop::truncate();
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
