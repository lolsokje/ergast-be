<?php

namespace App\Actions\Imports;

use App\Models\DriverStanding;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DriverStandings
{
    use AsAction;

    public string $commandSignature = 'imports:driver_standings';

    protected array $columnMapping = [
        'driverStandingsId' => 'id',
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
        'positionText' => 'position_text',
    ];

    protected string $table = 'driver_standings';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        DriverStanding::truncate();
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
