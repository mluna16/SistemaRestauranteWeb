<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiV1Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @group api
     */
    public function testProduct()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
                ->get('api/v1/producto')
                ->seeJson([]);
    }

    /**
     * @group api
     */
    public function testProductInfoGet()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('api/v1/producto/Info/1')
            ->seeJson([]);
    }

    /**
     * @group api
     */
    public function testProductChangeReady()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('api/v1/producto/resetInventory')
            ->seeJson(['success'=>true]);
    }

    /**
     * @group api
     */
    public function testOrderStatusGet()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('api/v1/order/espera')
            ->seeJson([]);
    }

    /**
     * @group api
     */
    public function testOrderStore()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
                ->post('api/v1/order/store',['idProduct' =>1,'idTable' => 1,'cantidad'=> 1])
                ->seeJson(['success'=> true]);
    }

    /**
     * @group apiDelete
     */
    public function testOrderDestroy()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->delete('api/v1/order/delete/4')
            ->seeJson(['success'=> true]);
    }

    /**
     * @group api
     */
    public function testOrderEdit()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->put('api/v1/order/edit/8',['idProduct' =>1,'idProductEdit'=> 2])
            ->seeJson(['success'=> true]);
    }
    /**
     * @group api
     */
    public function testOrderChangeReady()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->post('api/v1/order/changeReady',['idOrder' =>8])
            ->seeJson(['success'=> true]);
    }
    /**
     * @group api
     */
    public function testOrderReturned()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->post('api/v1/order/returned',['id_order' =>8,'id_product' => 2,'type' => 1])
            ->seeJson(['success'=> true]);
    }
    /**
     * @group api
     */
    public function testOrderComment()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->post('api/v1/order/comentario',['idOrder' =>8,'comentario' => 'Test'])
            ->seeJson(['success'=> true]);
    }
    /**
     * @group api
     */
    public function testOrderDeleteComment()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->post('api/v1/order/delete/comentario',['idOrder' =>8,'comentario' => ''])
            ->seeJson(['success'=> true]);
    }

    /**
     * @group api
     */
    public function testTable()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
                ->get('/api/v1/table')
                ->seeJson(['success'=>true]);
    }

    /**
     * @group api
     */
    public function testTableId()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('/api/v1/table/show/1')
            ->seeJson(['success'=>true]);
    }
    /**
     * @group api
     */
    public function testTableAll()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('/api/v1/table/show')
            ->seeJson(['success'=>true]);
    }

    /**
     * @group api
     */
    public function testTableGetInvoice()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->get('/api/v1/table/getInvoice/1')
            ->seeJson(['success'=>true]);
    }

    /**
     * @group api
     */
    public function testUserCodeStore()
    {
        $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
            ->post('/api/v1/user/code',['iduser'=> 1,'codigo' =>'test'])
            ->seeJson(['success' => true]);
    }
}
