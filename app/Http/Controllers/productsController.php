<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Psy\Exception\Exception;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Http\Requests\CreateProductsRequest;
use SistemaRestauranteWeb\Http\Requests\EditProductRequest;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\ProductImage;
use SistemaRestauranteWeb\User;

/**
 * @property mixed CreatedBy
 */
class productsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductsRequest $request
     * @return Response
     */
    public function store(CreateProductsRequest $request)
    {
        $product = new Product();
        if($request->all()){

            $product->setCreatedBy(Auth::user()->id);
            $product->setLocalForAttribute();
            $product->name = $request->name;
            $product->cost = $request->cost;
            $product->description = $request->description;
            $product->limit = $request->limit;
            $product->inventory = $request->limit;
            $product->save();
            if ($product->save()) {

                if ($request->ajax()) return array('last_id' => $product->id);

            };
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return Response::json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, EditProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        if( $product->update())   return Response::json(['success' => true],200);
        else  return Response::json(['success' => false],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductsForAttrAndID($attr, $value)
    {
        $Product = new Product();
        return $Product->getProductsForAttrAndID($attr, $value);
    }




    public function softDelete($id,$action){
        if($action==1) {
            $Product = Product::findOrFail($id);
            $Product->setStatus($id);
            return Response::json('Bien', 200);
        }elseif($action==2){

            $user = Product::find($id);
            $file = ProductImage::where('id_product',$id)->firstOrFail();
            $path = public_path().'/images/product/'.$id;

            if (!File::deleteDirectory($path))
            {
                return Response::json($path, 500);
            }
            else
            {
                $file->delete();
                $user->delete();
                return Response::json('Bien', 200);

            }

        }
    }

    public function resetInventory(){
        $product = new Product();
        if($product->resetInventory()) return Response::json(['success' => true], 200);
        else return Response::json(['success' => false], 401);
    }



    /**
     * --API--
     */

    public function getProducts()
    {

        $Product = new Product();

        try {
            $statusCode = 200;
            $response = $Product->getAllProductInformationByLocalFor();



        }catch (Exception $e) {
            $response = [
                "error" => "No hay productos para este usuario"
            ];
            $statusCode = 400;

        } finally {
            return Response::json($response, $statusCode);
        }
    }

    public function getProduct($id)
    {

        $Product = new Product();

        try {
            $statusCode = 200;
            $response = $Product->getAllInfoForProduct($id);

        }catch (Exception $e) {
            $response = [
                "error" => "No existe este producto"
            ];
            $statusCode = 404;

        } finally {
            return Response::json($response, $statusCode);
        }
    }


}
