<?php namespace SistemaRestauranteWeb\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;
use SistemaRestauranteWeb\User;
use Symfony\Component\HttpFoundation\File;

use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\LocalImage;

class localImageController extends BaseController {

    public function postUpload(){
        $user = new User();
        $fileInfo = Input::file('file');

        if(Input::hasFile('file')){

            $fileName=Hash::make($fileInfo->getClientOriginalName());

            $path = public_path().'/Images/Local';

            $fileType= $fileInfo->guessExtension();

            $fileSize = $fileInfo->getClientSize()/1024;

            $LocalImage        = new LocalImage();
            $LocalImage->name  = $fileName;
            $LocalImage->route = $path.'/'.$LocalImage->getlastLocalIdCreetedForUser();
            $LocalImage->type  = $fileType;
            $LocalImage->size  = $fileSize;
            $LocalImage->id_local = $LocalImage->getlastLocalIdCreetedForUser();

            if ($LocalImage->save()) {
                $fileInfo->move($LocalImage->route , $fileName . '.' . $fileType);
                $user->UpdateFirstTimeUser();
            }


        }

    }


}
