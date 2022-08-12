<?php

namespace App\Actions\Imports;

use App\Models\Status;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class Statuses
{
    use AsAction;

    public string $commandSignature = 'imports:statuses';

    protected array $columnMapping = [
        'statusId' => 'id',
    ];

    protected string $table = 'statuses';
    protected string $fileName = 'status';

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        Status::truncate();
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
