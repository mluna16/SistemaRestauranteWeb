<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Psy\Exception\Exception;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SistemaRestauranteWeb\Http\Requests\CreateProductsRequest;
use SistemaRestauranteWeb\Product;
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

        $Product = Product::create($request->all());
        $Product->setCreatedByAttribute($Product->created_by);
        $Product->setLocalForAttribute(1);
        if ($Product->save()) {

            if ($request->ajax()) return array('last_id' => $Product->id);

        };
        return $Product;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = new Product();
        return $product->getProductsForId($id);
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
    public function update($id)
    {
        //
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

    public function getProductForUser($value)
    {

        $Product = new Product();

        try {
            $response = [
                'Products' => []
            ];

            $statusCode = 200;
            $products = $Product->getProductsForCreatedBy($value);

            foreach ($products as $product) {
                $response['Products'][] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'cost' => $product->cost,
                    'description' => $product->description,
                    'limit' => $product->limit,
                ];
            }
        }catch (Exception $e) {
            $response = [
                "error" => "No hay productos para este usuario"
            ];
            $statusCode = 404;

        } finally {
            return Response::json($response, $statusCode);
        }
    }

    public function getProductForLocal($value){
        $Product = new Product();
        return $Product->getProductsForLocal($value);
    }
}
