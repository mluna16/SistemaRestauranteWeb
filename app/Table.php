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

    public function getAllTablesForLocal($id){
        $local = new Local();
        $totalMesas = $local->NumberTable();
        $mesas = [
            'TotalMesas' => $totalMesas,
            'Mesas'  => []
        ];
        $mesa = Table::where(['number_table' => 2,'state' => 'ocupado','id_local' => $id])->take(1);
        for($i = 1 ;$i <= $totalMesas;$i++)
        {
            $tabla = Table::where(['number_table' => $i,'state' => 'ocupado','id_local' => $id])->get();

            if ( ! $tabla->isEmpty())
            {
                $mesas['Mesas'][] = [

                    'NumberTable' => $tabla->first()->number_table,
                    'State' => $tabla->first()->state
                ];

            }else
            {
                $mesas['Mesas'][] = [

                    'NumberTable' => $i,
                    'State' => 'disponible'
                ];
            }
        }
        return $mesas;

    }
    public function getInfoTableForNumberTable($id)
    {
        $local = new Local();
        $product = new Product();
        $totalMesas = $local->NumberTable();
        $mesa = [
            'CostTable' => 0,
            'NumberTable' => $id,
            'Pedidos' => []
        ];
        if ($id <= $totalMesas) {
            $mesasData = Table::where(['number_table' => $id, 'id_local' => $local->getLocalIdAttribute()])->get();
            foreach ($mesasData as $mesaData) {
                $orderData = Order::find($mesaData->id_order);
                $mesa['CostTable'] = $mesa['CostTable'] + $product->getProductAttributeForId($orderData->id_product, 'cost');
                $mesa['Pedidos'][] = [
                    'State' => $mesaData->state,
                    'OrderId' => $orderData->id,
                    'OrderState' => $orderData->state,
                    'ProductId' => $orderData->id_product,
                    'ProductName' => $product->getProductNameAttribute($orderData->id_product),
                    'ProductCost' => $product->getProductAttributeForId($orderData->id_product, 'cost'),
                ];
            }
            return $mesa;
        }else{
            return false;
        }
    }
}
