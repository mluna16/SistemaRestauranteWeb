<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductImage extends Model {

    protected $table = 'product_image';
    protected $fillable = ['name','route', 'type','size','id_product'];

	public function product(){
        $this->belongsTo('SistemaRestauranteWeb\Product');
    }

    public function getLastProductIdCreatedForUser(){
        $product = Product::where('created_by', Auth::user()->id)->orderby('id','DESC')->take(1)->firstOrFail()->id;

        return $product;
    }

    public  function getAllProductInformation($id){
        $productList = Product::where('created_by',$id)->get();
        $productImage = [
            'product' => []
        ];
        foreach($productList as $product){
            $productImages = ProductImage::where('id_product',$product->id)->firstOrFail();
            $productImage['product'][] = [
                'id' => $productImages->id,
                'id_product' => $productImages->id_product,
                'images' => $productImages->route."".$productImages->name.".".$productImages->type
            ];
        }
        return $productImage;

    }
}
