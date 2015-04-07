<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;
use SistemaRestauranteWeb\Product;
use SistemaRestauranteWeb\ProductImage;

use Illuminate\Http\Request;

class productImageController extends Controller {

	public function postUploadImage($id){

        $fileInfo = Input::file('file');

        if(Input::hasFile('file')){

            $fileName=Hash::make($fileInfo->getClientOriginalName());

            $path = public_path().'/Images/Product';

            $fileType=$fileInfo->guessExtension();

            $fileSize = $fileInfo->getClientSize()/1024;

            $product=Product::find($id);

            $ProductImage        = new ProductImage;
            $ProductImage->name  = $fileName;
            $ProductImage->route = $path;
            $ProductImage->type  = $fileType;
            $ProductImage->size  = $fileSize;

            $ProductImage->product()->associate($product);

            if($ProductImage->move($path,$fileName.'.'.$fileType->guessExtension())){
                $ProductImage->save();
            }

        }

    }

}
