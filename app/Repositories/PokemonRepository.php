<?php


namespace App\Repositories;


use App\Models\Pokemon;

class PokemonRepository implements Repository
{

    public function all()
    {
        return Pokemon::all()->toArray();
    }
}
