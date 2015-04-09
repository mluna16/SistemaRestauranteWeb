<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use Symfony\Component\HttpFoundation\File;

use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\ProductImage;

class productImageController extends BaseController  {


    /**
     * @param $id
     */
    public function postUpload($id){

        $fileInfo = Input::file('file');

        if(Input::hasFile('file')){

            $fileName=Hash::make($fileInfo->getClientOriginalName());

            $path = public_path().'/Images/Product';

            $fileType= $fileInfo->guessExtension();

            $fileSize = $fileInfo->getClientSize()/1024;

            $product  =  Product::find($id);

            $ProductImage        = new ProductImage;
            $ProductImage->name  = $fileName;
            $ProductImage->route = $path;
            $ProductImage->type  = $fileType;
            $ProductImage->size  = $fileSize;
            $ProductImage->id_product = $ProductImage->lastProductIdCreetedForUser();

            if($fileInfo->move($path,$fileName.'.'.$fileType)){
                $ProductImage->save();
            }

        }

    }





}
