<?php

namespace App\Actions\Imports;

use DB;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Import
{
    private string $table = '';

    protected function performImport(string $table, array $data): void
    {
        $this->table = $table;
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
    protected function getFile()
    {
        $path = storage_path('app/imports/drivers.csv');
        if (!file_exists($path)) {
            throw new FileNotFoundException("Drivers CSV file not found");
        }

        return fopen($path, 'r');
    }

    protected function combineData($file, array $headers): array
    {
        $data = [];
        while (($line = fgetcsv($file)) !== false) {
            $data[] = array_combine($headers, $this->removeNullValues($line));
        }

        return $data;
    }

    protected function parseHeaders(array $fileHeaders): array
    {
        foreach ($fileHeaders as $key => $header) {
            $fileHeaders[$key] = $this->columnMapping[$header] ?? $header;
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
