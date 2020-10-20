<?php


namespace App\Models;

require "config/db.php";

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';
    public $timestamps = true;
}
