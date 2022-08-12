<?php

namespace App\Actions\Imports;

use App\Models\QualifyingResult;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class QualifyingResults
{
    use AsAction;

    public string $commandSignature = 'imports:qualifying_results';

    protected array $columnMapping = [
        'qualifyId' => 'id',
        'raceId' => 'race_id',
        'driverId' => 'driver_id',
        'constructorId' => 'constructor_id',
    ];

    protected string $table = 'qualifying_results';
    protected string $fileName = 'qualifying';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        QualifyingResult::truncate();
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
