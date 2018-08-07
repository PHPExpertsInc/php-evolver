<?php

namespace PHPExperts\GAO;

use DirectoryIterator;
use Illuminate\Support\Collection;

class DataManager
{
    public function loadCsvDir(String $inDir): Collection
    {
        $allData = [];
        foreach (new DirectoryIterator($inDir) as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $allData[] = $this->csvToArray($fileInfo->getPathname());
            }
        }

        return collect($allData);
    }

    public function split(Collection $data, Float $testDataRatio): Collection
    {
        return $data->partition(function () use ($testDataRatio) {
            return mt_rand() / mt_getrandmax() > $testDataRatio;
        });
    }

    public function save(String $outFile, Collection $contents)
    {
        file_put_contents($outFile, json_encode($contents->values()));
    }

    public function load(String $inFile): Collection
    {
        return collect(json_decode(file_get_contents($inFile)));
    }

    public function setMemoryLimit($limit = '1G')
    {
        ini_set('memory_limit', $limit);
    }

    public function csvToArray(String $filepath, Bool $headings = false): array
    {
        $rows = array_map('str_getcsv', file($filepath));

        if ($headings) {
            array_shift($rows);
        }

        return $rows;
    }
}
