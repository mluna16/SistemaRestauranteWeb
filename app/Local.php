<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed owner
 */
class Local extends Model {



	protected $table = 'local';

    protected $filltable = ['name','number_tables', 'owner','location','img_local'];

    public function getNameOwnerAttribute(){
       return User::where('id', $this->owner)->firstOrFail()->FullName;

    }

    public function  getMesasAttribute(){
        $ownerID = User::where('id',Auth::user()->id)->firstOrFail()->created_by;
        $mesas = Local::where('owner',$ownerID)->firstOrFail()->number_tables;
        return $mesas;
    }
    public function Product() {
        return $this->hasOne('SistemaRestauranteWeb\Product');
    }

}
