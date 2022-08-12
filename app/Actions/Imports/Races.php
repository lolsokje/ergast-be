<?php

namespace App\Actions\Imports;

use App\Models\Race;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Races
{
    use AsAction;

    public string $commandSignature = 'imports:races';

    protected array $columnMapping = [
        'raceId' => 'id',
        'circuitId' => 'circuit_id',
    ];

    protected string $table = 'races';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Race::truncate();
        (new Import())->handle($this->table, $this->columnMapping);
    }

    public function asCommand(Command $command): void
    {
        try {
            $this->handle();

            $command->info(ucfirst($this->table) . ' imported');
        } catch (Exception $e) {
            $command->error($e->getMessage());
        }
    }
}
