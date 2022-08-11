<?php

namespace App\Actions\Imports;

use App\Season;
use Exception;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class Seasons
{
    use AsAction;

    public string $commandSignature = 'imports:seasons';

    protected string $table = 'seasons';

    protected array $columnMapping = [];

    public function handle()
    {
        Season::truncate();
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
