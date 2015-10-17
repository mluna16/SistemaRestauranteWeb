<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Devuelto extends Model {

    protected $table = 'returned';
    protected $fillable = ['id_order','motivo','id_product','id_local','type'];

    public function crearNuevo($request)
    {
        $data = Devuelto::create($request);
        return $data;
    }


}
