<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'product';
    protected $fillable = ['name','cost', 'description','limit','created_by','local_for'];


}
