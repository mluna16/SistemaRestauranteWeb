<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

	public function Product(){
        $this->belongsTo('Product');
    }

}
