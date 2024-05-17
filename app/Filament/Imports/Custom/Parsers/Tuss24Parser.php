<?php

namespace App\Filament\Imports\Custom\Parsers;

class Tuss24Parser
{
    public function parseXmlFile(string $filePath): string
    {
        $xmlString = file_get_contents($filePath);
        $xml = simplexml_load_string($xmlString);

        $json = json_encode($xml);
        $array = json_decode($json, true);

        $data = [];

        $data[] = array_keys($array['concept'][0]);

        foreach ($array['concept'] as $item) {
            $arr = [
                '@attributes' => [
                    'code' => $item['code']['@attributes']['value'],
                    'display' => $item['display']['@attributes']['value'],
                ]
            ];
            $data[] = $arr['@attributes'];
        }

        $csvFile = $filePath . '.csv';

        $handle = fopen($csvFile, 'w');

        foreach ($data as $row) {
            fputcsv($handle, $row, ';');
        }

        fclose($handle);

        return $csvFile;
    }
}
