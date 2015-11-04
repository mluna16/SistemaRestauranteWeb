<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    protected $table    = 'invoice';
    protected $fillable = ['client_id','client_name','id_invoice','costo','email','created_by'];

    public function createNew($request)
    {
        $data = $this->create($request);
        return $data;
    }

}
