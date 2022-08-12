<?php

namespace App\Actions\Imports;

use App\Models\RaceResult;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class RaceResults
{
    use AsAction;

    public string $commandSignature = 'imports:race_results';

    protected array $columnMapping = [
        'resultId' => 'id',
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
        'constructorId' => 'constructor_id',
        'statusId' => 'status_id',
        'positionText' => 'position_text',
        'positionOrder' => 'position_order',
        'fastestLap' => 'fastest_lap_number',
        'rank' => 'fastest_lap_rank',
        'fastestLapTime' => 'fastest_lap_time',
        'fastestLapSpeed' => 'fastest_lap_speed',
    ];

    protected string $table = 'race_results';
    protected string $fileName = 'results';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        RaceResult::truncate();
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
