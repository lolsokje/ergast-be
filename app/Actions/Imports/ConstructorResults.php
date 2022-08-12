<?php

namespace App\Actions\Imports;

use App\Models\ConstructorResult;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class ConstructorResults
{
    use AsAction;

    public string $commandSignature = 'imports:constructor_results';

    protected array $columnMapping = [
        'constructorResultsId' => 'id',
        'raceId' => 'race_id',
        'constructorId' => 'constructor_id',
    ];

    protected string $table = 'constructor_results';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        ConstructorResult::truncate();
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
