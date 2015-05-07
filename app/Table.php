<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

    protected $table = 'table';
    protected $fillable = ['number_table','number_seat', 'state','id_order','id_local'];


    /**
     * Este Model contiene los siguientes Metodos :
     *
     *
     *
     */

    public function Order(){
        return $this->belongsTo('id_order','order');

    }

}
