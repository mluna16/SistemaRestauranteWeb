<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use SistemaRestauranteWeb\Http\Controllers\productsController;
use Symfony\Component\HttpFoundation\Response;

class Product extends Model {

    protected $table = 'product';
    protected $fillable = ['name','cost', 'description','limit','created_by','inventory','local_for'];

    /**
     * @param $value
     */
    public function setCreatedBy($value){
        $this->attributes['created_by'] = $value;
    }
    public function setLocalForAttribute(){
        $local = new Local();
        $this->attributes['local_for'] = $local->getLocalIdAttribute();
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

    public  function getAllProductInformationByLocalFor(){
        $local = new Local();
        $productList = Product::where('local_for',$local->getLocalIdAttribute())
                                ->where('inventory','>',0)
                                ->get();
        foreach($productList as $product){
            /** @var TYPE_NAME $productImages */
            $productImages = ProductImage::where('id_product',$product->id)->firstOrFail();

            $productImage[] = [

                'id_product' => $product->id,
                'name' => $product->name,
                'cost' => $product->cost,
                'limit' => $product->limit,
                'inventory' => $product->inventory,
                'description' => $product->description,
                'status' => $product->stautus,
                'id_image' => $productImages->id,
                'image' => $this->renameRouteImage($productImages)
            ];
        }
        return Collection::make($productImage);


    }
    public function getAllInfoForProduct($id){
        $product = Product::where('id',$id)->get()->first();
        $productImages = ProductImage::where('id_product',$id)->get()->first();

            $productinfo[] = [

                'id_product' => $product->id,
                'name' => $product->name,
                'cost' => $product->cost,
                'limit' => $product->limit,
                'description' => $product->description,
                'status' => $product->stautus,
                'id_image' => $productImages->id,
               'image' => $this->renameRouteImage($productImages)
            ];

        return Collection::make($productinfo);


    }
    public function setStatus($value){
        $product = Product::find($value);
        if($product->status == true) Product::where('id',$value)->update(['status' => false]);
        else Product::where('id',$value)->update(['status' => true]);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getProductNameAttribute($value){
        return Product::find($value)->name;
    }
    public function getProductAttributeForId($value, $attr){
        return Product::find($value)->$attr;
    }

    public  function updateInventory($value,$action){
        $product = Product::find($value);

        if($action==true)   $Inventory= $product->inventory - 1;
        else                $Inventory= $product->inventory + 1;
        Product::where('id', $value)->update(['inventory' => $Inventory]);
    }

    public function resetInventory(){
        $local = new local();
        $products = Product::where('local_for',$local->getLocalIdAttribute())->get();

        foreach($products as $product){
            Product::where('id', $product->id )->update(['inventory' => $product->limit]);
        }
        return true;

    }

    public function getCostProduct($id){
        return Product::find($id)->cost;
    }

    public function getName($id)
    {
        return Product::find($id)->name;

    }
    //Relaciones de clave foraneas

    public function User() {
        return $this->hasOne('SistemaRestauranteWeb\User');
    }
    public function productImage() {
        return $this->hasOne('SistemaRestauranteWeb\ProductImage');
    }

    public function renameRouteImage($array)
    {
        $path = public_path();
        $route = str_replace($path, "", $array['route']);
        $route = $route.'/'.$array['name'].'.'.$array['type'];
        return $route;
    }


}


