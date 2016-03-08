<?php namespace SistemaRestauranteWeb;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'order';
    protected $fillable = ['state','created_by', 'id_product','id_local','comentario','comentario_visto'];

    /**
     * Este Model contiene los siguientes Metodos :
     *
     *
     *
     */
        public  function Table(){
            return $this->hasOne('SistemaRestauranteWeb\Table');
        }

    public function getOrdenProductoPorfecha($id_product, $time,$idLocal)
    {
        return Order::where('id_product' ,$id_product)
                    ->where( 'created_at', '>=',Carbon::now()->subDays($time) )
                    ->where('id_local',$idLocal)
                    ->count();

    }
    public function getOrdenMesoneroPorfecha($id_user, $time,$idLocal)
    {
        return Order::where('created_by' ,$id_user)
                        ->where( 'created_at', '>=',Carbon::now()->subDays($time))
                        ->where('id_local',$idLocal)
                        ->subDays($time)->count();

    }
    public function getOrdenVentas($time,$idLocal)
    {
        return Order::where('created_at', '>=',$time)
                    ->where('id_local',$idLocal)
                    ->get(['id_product']);

    }
    public function getOrdenVentasdobles($time,$time2,$idLocal)
    {
        return Order::where('created_at', '>=',$time)
                    ->where('created_at', '<=',$time2)
                    ->where('id_local',$idLocal)
                      ->get(['id_product']);

    }

    public function getOrdernerPorEstadoYLocal($estado, $local)
    {
        $order  =  Order::where(['id_local' => $local,'state' => $estado ])->get();
        return $order;
    }

    public function setStatus($id)
    {
        $order = Order::find($id);
        if($order['state'] == "listo"){
            Order::where('id',$id)->update(['state' => 'espera']);
        }else{
            Order::where('id',$id)->update(['state' => 'listo']);
        }
        return true;
    }

    public function setStatusReturned($id)
    {
        Order::where('id',$id)->update(['state' => 'devuelto']);

        return true;
    }

    public function editar($id,$request)
    {
        $order  =  Order::where(['id' => $id])->update(['id_product' => $request->idProduct]);
        return $order;
    }

    public function addOrEditComentario($id,$request)
    {
        $order  =  Order::where(['id' => $id])->update([
                                                        'comentario'        => $request->comentario,
                                                        'comentario_visto'  => false
                                                        ]);
        return $order;
    }

    public function remove($id){
        $data = $this->where('id', $id)->delete();
        return $data;
    }


}
