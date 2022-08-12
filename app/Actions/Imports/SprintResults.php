<?php

namespace App\Actions\Imports;

use App\Models\SprintResult;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class SprintResults
{
    use AsAction;

    public string $commandSignature = 'imports:sprint_results';

    protected array $columnMapping = [
        'resultId' => 'id',
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
        'constructorId' => 'constructor_id',
        'statusId' => 'status_id',
        'positionText' => 'position_text',
        'positionOrder' => 'position_order',
        'fastestLap' => 'fastest_lap_number',
        'fastestLapTime' => 'fastest_lap_time',
    ];

    protected string $table = 'sprint_results';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        SprintResult::truncate();
        (new Import())->handle($this->table, $this->columnMapping);
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
