<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

    protected $table = 'table';
    protected $fillable = ['number_table','number_seat', 'state','id_order','id_local','facturar'];


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
        for($i = 1 ;$i <= $totalMesas;$i++)
        {
            $tabla = Table::where(['number_table' => $i,'state' => 'ocupado','id_local' => $id])->get();

            if ( ! $tabla->isEmpty())
            {
                $mesas['Mesas'][] = [

                    'NumberTable' => $tabla->first()->number_table,
                    'State' => $tabla->first()->state,
                    'Facturar' => $tabla->first()->facturar
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
        $extra      = new ExtraOrden();
        $totalMesas = $local->NumberTable();
        $mesa = [
            'CostTable' => 0,
            'NumberTable' => $id,
            'Pedidos' => []
        ];
        if ($id <= $totalMesas) {
            $mesasData = Table::where(['number_table' => $id,
                                        'id_local' => $local->getLocalIdAttribute(),
                                        'state' => 'ocupado'])->get();

            foreach ($mesasData as $i =>$mesaData) {
                $orderData = Order::find($mesaData->id_order);


                $mesa['CostTable'] = $mesa['CostTable'] + $product->getProductAttributeForId($orderData->id_product, 'cost');
                $mesa['Pedidos'][] = [
                    'State' => $mesaData->state,
                    'Facturar' => $mesaData->facturar,
                    'OrderId' => $orderData->id,
                    'OrderState' => $orderData->state,
                    'ProductId' => $orderData->id_product,
                    'ProductName' => $product->getProductNameAttribute($orderData->id_product),
                    'ProductCost' => $product->getProductAttributeForId($orderData->id_product, 'cost'),
                    'Extra'         => null,
                ];

                if($extra->countExtra($mesaData->id_order) >0){
                    $extraData = $extra->getForIsOrder($mesaData->id_order);
                    $mesa['CostTable'] = $mesa['CostTable'] + $extraData['costoExtra'];
                    $mesa['Pedidos'][$i]['Extra'] = $extraData['data'];
                    $mesa['Pedidos'][$i]['ProductCost'] = $mesa['Pedidos'][$i]['ProductCost'] + $extraData['costoExtra'];

                }
            }
            return $mesa;
        }else{
            return false;
        }
    }

    function changeInvoiceTableStatus($id)
    {
        $local = new Local();
        $mesas = Table::where(['number_table' => $id, 'id_local' => $local->getLocalIdAttribute(),'state' => 'ocupado'])
                        ->get();
        foreach($mesas as $mesa){
            if($mesa->facturar == false)
            {
                Table::where(['number_table' => $id, 'id_local' => $local->getLocalIdAttribute(),'state' => 'ocupado'])
                            ->update(['facturar' => true]);
            }
            else
            {
                Table::where(['number_table' => $id, 'id_local' => $local->getLocalIdAttribute(),'state' => 'ocupado'])
                        ->update(['facturar' => false]);
            }
        }
    }

    public function changeStatusTable($id)
    {
        $local = new Local();

         Table::where(['number_table' => $id,
                                    'id_local' => $local->getLocalIdAttribute(),
                                    'state' => 'ocupado'])->update(['state'=>'facturado']);
    }


    function getNumeroDeMesaPorOrder($idOrder)
    {
        $table  = Table::where('id_order', $idOrder)->get();
        return $table;
    }

    function checkTableInit($numTable)
    {
        $data = $this->where('number_table',$numTable)
                    ->where('state','ocupado')
                    ->count();
        if($data > 0){
            $data = false;
        }else{
            $data = true;
        }

        return $data;
    }
}
