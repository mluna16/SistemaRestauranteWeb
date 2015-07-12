<?php namespace SistemaRestauranteWeb;

use Carbon\Carbon;
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

    public function getOrdenProductoPorfecha($id_product, $time)
    {
        return Order::where('id_product' ,$id_product)->where( 'created_at', '>=',Carbon::now()->subDays($time) )->count();

    }
    public function getOrdenMesoneroPorfecha($id_user, $time)
    {
        return Order::where('created_by' ,$id_user)->where( 'created_at', '>=',Carbon::now()->subDays($time) )->count();

    }


}
