<?php

namespace App\Actions\Imports;

use App\Models\Constructor;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Constructors
{
    use AsAction;

    public string $commandSignature = 'imports:constructors';

    protected string $table = 'constructors';

    protected array $columnMapping = [
        'constructorId' => 'id',
        'constructorRef' => 'constructor_ref',
    ];

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Constructor::truncate();
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
