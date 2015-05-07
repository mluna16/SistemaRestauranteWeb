<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LocalImage extends Model {

    protected $table = 'local_image';
    protected $fillable = ['name','route', 'type','size','id_local'];

    public function local(){
        $this->belongsTo('SistemaRestauranteWeb\Local');
    }

    public function getlastLocalIdCreetedForUser(){
        return  Local::where('owner', Auth::user()->id)->orderby('id','DESC')->take(1)->firstOrFail()->id;
    }

}
