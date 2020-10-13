<?php

namespace App\Commands;

use App\Models\Pokemon;

class DbSeedCommand
{
    public function run()
    {
        echo "------ Pokedex Database Seed Command ------\n";
        $apiUrl = "https://pokeapi.co/api/v2/pokemon?limit=150&offset=0";
        $pokemonArr = [];

        echo "Consultando: {$apiUrl}\n";
        $apiConn = \curl_init($apiUrl);
        \curl_setopt($apiConn, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = json_decode(curl_exec($apiConn), true);
        \curl_close($apiConn);

        echo "Agregando Pokemons a memoria temporal .";
        foreach ($apiResponse['results'] as $response) {
            $outpuCommandMsgTimeStatus = '.';

            echo $outpuCommandMsgTimeStatus;

            $pokemonApiConn = \curl_init($response['url']);
            \curl_setopt($pokemonApiConn, CURLOPT_RETURNTRANSFER, true);
            $pokemonData = json_decode(curl_exec($pokemonApiConn), true);
            \curl_close($pokemonApiConn);

            array_push($pokemonArr, [
                'code' => str_pad((string)$pokemonData['id'], 3, "0", STR_PAD_LEFT),
                'name' => ucwords($pokemonData['name']),
                'image' => $pokemonData['sprites']['other']['official-artwork']['front_default'],
                'height' => (string)$pokemonData['height'],
                'weight' => (string)$pokemonData['weight'],
                'ability' => ucwords($pokemonData['abilities'][0]['ability']['name']),
            ]);
        }

        echo "\nInsertando pokemons en la base de datos.\n";
        Pokemon::insert($pokemonArr);

        echo "Pokemons insertados con exito!\n";
    }
}
