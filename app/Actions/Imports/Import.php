<?php

namespace App\Actions\Imports;

use DB;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Import
{
    private string $table;
    private $file;

    /**
     * @throws FileNotFoundException
     */
    public function handle(string $table, array $columnMapping): void
    {
        $this->table = $table;
        $this->getFile();

        $headers = $this->parseHeaders(fgetcsv($this->file), $columnMapping);
        $data = $this->combineData($headers);

        $this->performImport($data);
    }

    protected function performImport(array $data): void
    {
        foreach ($data as $row) {
            $this->insertRow($row);
        }
    }

    private function insertRow(array $row): void
    {
        $columns = $this->getColumnStringForQuery($row);
        $values = $this->getValuesStringForQuery($row);

        $query = "INSERT INTO $this->table ($columns) VALUES ($values)";
        DB::insert($query, array_values($row));
    }

    private function getColumnStringForQuery(array $columns): string
    {
        return implode(',', array_keys($columns));
    }

    private function getValuesStringForQuery(mixed $row): string
    {
        return implode(',', array_fill(0, count($row), '?'));
    }

    /**
     * @throws FileNotFoundException
     */
    protected function getFile(): void
    {
        $path = storage_path("app/imports/$this->table.csv");
        if (!file_exists($path)) {
            $tableName = ucfirst($this->table);
            throw new FileNotFoundException("$tableName CSV file not found");
        }

        $this->file = fopen($path, 'r');
    }

    protected function combineData(array $headers): array
    {
        $data = [];
        while (($line = fgetcsv($this->file)) !== false) {
            $data[] = array_combine($headers, $this->removeNullValues($line));
        }

        return $data;
    }

    protected function parseHeaders(array $fileHeaders, array $columnMapping): array
    {
        foreach ($fileHeaders as $key => $header) {
            $fileHeaders[$key] = $columnMapping[$header] ?? $header;
        }

        return $fileHeaders;
    }

    private function removeNullValues(bool|array $line): array|bool
    {
        foreach ($line as $key => $column) {
            if ($column === '\N') {
                $line[$key] = null;
            }
        }
        return $line;
    }
}
