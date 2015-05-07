<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'order';
    protected $fillable = ['state','created_by', 'id_product',];

    /**
     * Este Model contiene los siguientes Metodos :
     *
     *
     *
     */
        public  function Table(){
            return $this->hasOne('SistemaRestauranteWeb\Table');

        }


}
