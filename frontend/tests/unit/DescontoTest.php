<?php
namespace frontend\tests;

use common\models\Desconto;
use common\models\Modelo;

class DescontoTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidacoes()
    {
        $desconto = new Desconto();

        //data_comeco
        $desconto->data_comeco = '2021-12-01';
        $this->assertTrue($desconto->validate(['data_comeco']));

        $desconto->data_comeco = null;
        $this->assertFalse($desconto->validate(['data_comeco']));

        //data_final
        $desconto->data_final = '2021-12-01';
        $this->assertTrue($desconto->validate(['data_final']));

        $desconto->data_final = null;
        $this->assertFalse($desconto->validate(['data_final']));

        //valor
        $desconto->valor = 20;
        $this->assertTrue($desconto->validate(['valor']));

        $desconto->valor = 20.20;
        $this->assertFalse($desconto->validate(['valor']));

        $desconto->valor = 'aaa';
        $this->assertFalse($desconto->validate(['valor']));

        $desconto->valor = null;
        $this->assertFalse($desconto->validate(['valor']));
    }

    public function testDesconto(){
        $modelo = new Modelo();
        $desconto = new Desconto();

        //insert na base de dados
        $modelo->id = 1;
        $modelo->nome = 'modelo teste';
        $modelo->save();
        $desconto->id_modelo = $modelo->id;
        $desconto->data_comeco = '2021-12-01';
        $desconto->data_final = '2021-12-02';
        $desconto->valor = 10;
        $desconto->save();

        //verificar se o registo válido se encontra na BD
        $readDesconto = Desconto::findOne($desconto->id_modelo);

        $this->assertNotNull($readDesconto);
        $this->assertIsObject($readDesconto);

        //aplicar um update
        $readDesconto->valor = 15;
        $readDesconto->save();

        //verificar se o registo atualizado se encontra na BD
        $updatedesconto = Desconto::findOne(['valor' => 15]);

        $this->assertNotNull($updatedesconto);

        //apagar um registo
        $updatedesconto->delete();

        $deletedesconto = Desconto::findOne(['valor' => 15]);
        //verificar que o registo não se encontra na BD
        $this->assertNull($deletedesconto);
    }
}