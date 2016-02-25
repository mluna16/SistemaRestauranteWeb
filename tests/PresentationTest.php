<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PresentationTest extends TestCase
{
    /**
     * @group inicio
     */
        public function testHome()
        {
            $this->visit('/')->see('Marcos Luna');
        }
    /**
     * @group inicio
     */
        public function testLoginView()
        {
            $this->visit('/auth/login')->see('Iniciar Sesion');
        }
    /**
     * @group inicio
     */
        public function testRegisterView()
        {
            $this->visit('/auth/register')->see('Crear Cuenta');
        }
    /**
     * @group inicio
     */

        public function testloginAdmin()
        {
            $this->visit('/auth/login')
                ->type('marcos@luna.com','email')
                ->type('12345','password')
                ->press('Iniciar Sesion!')
                ->seePageis('/admin');
        }

    /**
     * @group inicio
     */
        public function testloginCaja()
        {
            $this->visit('/auth/login')
                ->type('caja@luna.com','email')
                ->type('12345','password')
                ->press('Iniciar Sesion!')
                ->seePageis('/caja');
        }

    /**
     * @group inicio
     */
        public function testLoginMesonero()
        {
            $this->post('/api/v1/login',['email' => 'mesonero@luna.com','password' => 12345])
                ->seeJson(["success"=>true,]);
        }

    /**
     * @group inicio
     */
    public function testLoginCocina()
    {
        $this->post('/api/v1/login',['email' => 'cocina@luna.com','password' => 12345])
             ->seeJson(["success"=>true,]);
    }
}
