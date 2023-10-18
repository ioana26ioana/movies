<?php

namespace App\Http\Controllers;

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests\AddItem;
use Recombee\RecommApi\Requests\AddItemProperty;
use Recombee\RecommApi\Requests\SetItemValues;

class MovieController extends Controller
{
    public function addItems() {
        $client = new Client("proiect-lab1-sac-movies", 'i0fLTiLTzHv3vuRmjcobZ4w0B9ZqFoM8Ns8Tt3mtij5wlVV5cwl0HIZzmg8zMo2o', ['region' => 'eu-west']);
        $client->send(new AddItemProperty('title', 'string'));
        $client->send(new AddItemProperty('runtime', 'string'));
        $client->send(new AddItemProperty('genre', 'string'));
        $client->send(new AddItemProperty('imdb_rating', 'double'));
        $client->send(new AddItemProperty('overview', 'string'));
        $client->send(new AddItemProperty('meta_score', 'int'));
        $client->send(new AddItemProperty('no_of_votes', 'int'));
        $client->send(new AddItemProperty('released_year', 'int'));
    }

    public function addItemsProperties()
    {
        $client = new Client("proiect-lab1-sac-movies", 'i0fLTiLTzHv3vuRmjcobZ4w0B9ZqFoM8Ns8Tt3mtij5wlVV5cwl0HIZzmg8zMo2o', ["region" => "eu-west"]);
        $csvData = array_map('str_getcsv', file(public_path('movies_lab1_sac.csv')));
        $count = 0;
        for ($i = 1; $i < count($csvData); $i++) {
            if ($csvData[$i][2] != 'PG') {
                if ($csvData[$i][2] > 1970) {
                    $count++;
                    $client->send(new AddItem($count));
                    if (!isset($csvData[$i][8]) || $csvData[$i][8] == '' || $csvData[$i][8] == null || !$csvData[$i][8]) {
                        $csvData[$i][8] = 0;
                    }
                    $client->send(new SetItemValues($count, [
                            'title' => $csvData[$i][1],
                            'runtime' => $csvData[$i][4],
                            'genre' => $csvData[$i][5],
                            'overview' => $csvData[$i][7],
                            'imdb_rating' => $csvData[$i][6],
                            'meta_score' => $csvData[$i][8],
                            'no_of_votes' => $csvData[$i][14],
                            'released_year' => $csvData[$i][2],
                        ])
                    );
                }
            }
        }
    }
}
