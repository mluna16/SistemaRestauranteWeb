<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductImage extends Model {

    protected $table = 'product_image';
    protected $fillable = ['name','route', 'type','size','id_product'];

	public function product(){
        $this->belongsTo('SistemaRestauranteWeb\Product');
    }

    public function getlastProductIdCreetedForUser(){
        $product = Product::where('created_by', Auth::user()->id)->orderby('id','DESC')->take(1)->firstOrFail()->id;;

        return $product;
    }
}
