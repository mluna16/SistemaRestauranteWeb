<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;
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
            $vowels = array(".jpeg", ".jpg", ".png", ".JPEG", ".PNG", ".JPG");
            $fileNameChange = str_replace($vowels, "",$fileInfo->getClientOriginalName());
            $fileName = str_replace('/', "",\Hash::make($fileNameChange));


            $path = public_path().'/images/product';

            $fileType= $fileInfo->guessExtension();

            $fileSize = $fileInfo->getClientSize()/1024;

            $ProductImage        = new ProductImage;
            $ProductImage->name  = $fileName;
            $ProductImage->route = $path.'/'.$ProductImage->getLastProductIdCreatedForUser();
            $ProductImage->type  = $fileType;
            $ProductImage->size  = $fileSize;
            $ProductImage->id_product = $ProductImage->getLastProductIdCreatedForUser();

            if ($ProductImage->save()) {
                $fileInfo->move($ProductImage->route , $fileName . '.' . $fileType);

            }


        }

    }





}
