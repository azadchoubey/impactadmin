<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Keywordmaster;
class KeywordsExport implements FromCollection, WithHeadings
{
    protected $keywords;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($keywords)
    {
        $this->keywords = $keywords;
    }
    public function collection()
    {
        return $this->keywords->map(function ($keyword) {
            return [
                $keyword->KeyWord,
                $keyword->Filter_String,
                $this->formatClients($keyword->clientskeywords)
            ];
        });
    }
    protected function formatClients($clients)
    {
        $clientNames = $clients->map(function ($client) {
            return $client->clients ? $client->clients->Name : '';
        })->implode(', ');

        return $clientNames;
    }
    public function headings(): array
    {
        return [
            'Keyword',
            'Filter String',
            'Clients'
        ];
    }

}
