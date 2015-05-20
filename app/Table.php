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
            $hola = Table::where(['number_table' => $i,'state' => 'ocupado','id_local' => $id])->get();

            if ( ! $hola->isEmpty())
            {
                $mesas['Mesas'][] = [

                    'NumberTable' => $hola->first()->number_table,
                    'State' => $hola->first()->state
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
}
