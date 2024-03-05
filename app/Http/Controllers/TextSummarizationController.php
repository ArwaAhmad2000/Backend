<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TextSummarizationController extends Controller
{
    public function getRespone()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:5000', // Replace with the URL of your Flask API
        ]);

        $response = $client->post('/summarize', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => 'This is the text of a book that you want to summarize.',
            ],
        ]);

        $summary = json_decode($response->getBody(), true)['summary'];
        echo $summary;
    }
}