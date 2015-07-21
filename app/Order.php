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
    public function getOrdenVentas($time)
    {
        return Order::where('created_at', '>=',$time)->get(['id_product']);

    }
    public function getOrdenVentasdobles($time,$time2)
    {
        return Order::where('created_at', '>=',$time)->where('created_at', '<=',$time2)->get(['id_product']);

    }

    public function setStatus($id){
        Order::where('id',$id)->update(['state' => 'listo']);
        return true;
    }



}
