<?php
namespace App\Services;
use GuzzleHttp\Client;

class NBP
{    
    public function getCurrencies($table)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/'.$table, [
            'headers' => [
                'accept' => 'application/json',
            ]
        ]);
        if ($response->getStatusCode() == 200)
        {
            $content = json_decode($response->getBody());
            return $content[0];
        }
    }
}
