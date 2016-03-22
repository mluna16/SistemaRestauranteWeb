<?php

namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class ExtraOrden extends Model
{
    protected $table = 'extraorder';
    protected $fillable = ['id_order','id_product'];
    public $timestamps  = false;

    public function createNew($request)
    {
        $data =$this->create($request);
        return $data;
    }

    public function getForIsOrder($idOrder)
    {
        $product  = new Product();
        $data = $this->where('id_order',$idOrder)->get(['id_product']);
        $response['costoExtra'] = 0;
        foreach($data as $extra){
            $response['costaExtra'] = $response['costoExtra'] + $product->getCostProduct($extra['id_product']);
            $response['data'][] = ['nombreExtra' => $product->getName($extra['id_product'])];
        }
        return  $response;
    }

    public function countExtra($idOrder)
    {
        $data = $this->where('id_order',$idOrder)->count();
        return $data;
    }
}
