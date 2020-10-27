<?php


namespace App\Controllers;


use App\Repositories\PokemonRepository;


class PokemonController implements Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PokemonRepository();
    }

    public function index($params = null)
    {
        view('pokedex.html', ['pokemons' => $this->repository->all()]);
    }

    public function show()
    {
        return response()->json($this->repository->all(), 200);
    }
}
