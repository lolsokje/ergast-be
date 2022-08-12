<?php

namespace App\Actions\Imports;

use App\Models\Circuit;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Circuits
{
    use AsAction;

    public string $commandSignature = 'imports:circuits';

    protected array $columnMapping = [
        'circuitId' => 'id',
        'circuitRef' => 'circuit_ref',
    ];

    protected string $table = 'circuits';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Circuit::truncate();
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
