<?php

namespace App\Service;

class CottageCsvService
{
    private string $csvPath;

    public function __construct(string $csvPath)
    {
        $this->csvPath = $csvPath;
    }

    /**
     * Get all houses from CSV
     */
    public function getAllCottages(): array
    {
        $cottages = [];
        if (!file_exists($this->csvPath)) {
            return $cottages;
        }

        if (($handle = fopen($this->csvPath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ';', '"', '\\')) !== false) {
                // id;name;amenities;beds;rowFromSea
                if (count($data) < 5) {
                    continue;
                }
                $cottages[] = [
                    'id'          => (int)$data[0],
                    'name'        => $data[1],
                    'amenities'   => $data[2],
                    'beds'        => (int)$data[3],
                    'rowFromSea'  => (int)$data[4],
                ];
            }
            fclose($handle);
        }

        return $cottages;
    }
}
