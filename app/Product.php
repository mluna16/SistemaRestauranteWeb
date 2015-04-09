<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model {

    protected $table = 'product';
    protected $fillable = ['name','cost', 'description','limit','created_by','local_for'];

    /**
     * @param $value
     */
    public function setCreatedByAttribute($value){

        $this->attributes['created_by'] = Auth::user()->id;
    }
    public function setLocalForAttribute($value){

        $this->attributes['local_for'] = 1;
    }
    public function User() {
        return $this->hasOne('SistemaRestauranteWeb\User');
    }
    public function productImage() {
        return $this->hasOne('SistemaRestauranteWeb\ProductImage');
    }
}
