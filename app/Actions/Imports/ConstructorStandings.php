<?php

namespace App\Actions\Imports;

use App\Models\ConstructorStanding;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class ConstructorStandings
{
    use AsAction;

    public string $commandSignature = 'imports:constructor_standings';

    protected array $columnMapping = [
        'constructorStandingsId' => 'id',
        'raceId' => 'race_id',
        'constructorId' => 'constructor_id',
        'positionText' => 'position_text',
    ];

    protected string $table = 'constructor_standings';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        ConstructorStanding::truncate();
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
