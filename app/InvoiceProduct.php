<?php namespace SistemaRestauranteWeb;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model {

    protected $table    = 'invoice_product';
    protected $fillable = ['id_product','id_invoice','costo'];
    public  $timestamps = false;

    public function createNew($request)
    {
        $data = $this->create($request);
        return $data;
    }

    public function getProduct($id)
    {
        $product  = new Product();
        $data =  $this->where(['id_invoice' => $id] )->get(['id_product','costo']);
        $retorno = [];

        foreach ($data as $idPrduct){
            $retorno[] = [
                       'ProductName'            => $product->getProductNameAttribute($idPrduct['id_product']),
                       'ProductCost'            => $idPrduct['costo']
            ];
        }

        return $retorno;
    }

}
