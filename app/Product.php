<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SistemaRestauranteWeb\Http\Controllers\productsController;

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

        $this->attributes['local_for'] = Local::getLocalIdAttribute();
    }


    public function getProductsForCreatedBy($value){
        /** @var json $return */
        $return = Product::where('created_by', $value)->get();

        return $return;
    }

    public function getProductsForLocal($value){
        /** @var json $return */
        $return = Product::where('local_for', $value)->get();

        return $return;
    }
    public function getProductsForId($value){
        /** @var json $return */
        $product = new Product();
        if($product->checkProductByLocal($value)) {
            $return = Product::find($value);
            return $return;
        }else{
            return ['error' => "that product don't belong at this local "];
        }
    }
    public function getProductsForAttrAndID($attr , $value){
        /** @var json $return */
        $product = new Product();
        if($product->checkFilltableProduct($attr)) {
            if ($product->checkProductByLocal($value)) {
                $return = Product::find($value)->$attr;
                return $return;
            } else  return ['error' => "that product don't belong at this local "];

        }else  return  ['error' => "attr not found"];
    }

    public function checkFilltableProduct($attr){
        $alloweds = ['name','cost', 'description','limit'];
        foreach($alloweds as $allowed){
            if($allowed == $attr) return true;
        }
        return false;
    }

    public function checkProductByLocal($value){
        $product = new Product();
        $local = new Local();
        $datas = $product->getProductsForLocal($local->getLocalIdAttribute());
        foreach($datas as  $data){
            if($data->id == $value) return true;
        }
        return false;
    }

    //Relaciones de clave foraneas

    public function User() {
        return $this->hasOne('SistemaRestauranteWeb\User');
    }
    public function productImage() {
        return $this->hasOne('SistemaRestauranteWeb\ProductImage');
    }
}
