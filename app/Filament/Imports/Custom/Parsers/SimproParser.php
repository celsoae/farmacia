<?php

namespace App\Filament\Imports\Custom\Parsers;

class SimproParser
{
    public function parseXmlFile(string $filePath): string
    {
        $xmlString = file_get_contents($filePath);
        $xml = simplexml_load_string($xmlString);

        $json = json_encode($xml);
        $array = json_decode($json, true);

        $data = [];

        $data[] = array_keys($array['ITEM'][0]['@attributes']);

        foreach ($array['ITEM'] as $item) {
            $data[] = $item['@attributes'];
        }

        $csvFile = $filePath . '.csv';

        $handle = fopen($csvFile, 'w');

        foreach($data as $row) {
            fputcsv($handle, $row, ';');
        }

        fclose($handle);

        return $csvFile;
    }
}
