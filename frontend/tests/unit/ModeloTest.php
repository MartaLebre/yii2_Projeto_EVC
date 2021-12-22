<?php
namespace frontend\tests;

use common\models\Modelo;

class ModeloTest extends \Codeception\Test\Unit
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
        $modelo = new Modelo();

        //nome
        $modelo->nome = 'teste';
        $this->assertTrue($modelo->validate(['nome']));

        $modelo->nome = 'aadhfjhassaljfjashgdfashdfgjashdgfjashgdfjgasjdhfasdfgasdjhfasdfasdfasdfasd';
        $this->assertFalse($modelo->validate(['nome']));

        $modelo->nome = 100;
        $this->assertFalse($modelo->validate(['nome']));

        $modelo->nome = null;
        $this->assertFalse($modelo->validate(['nome']));
    }

    public function testModelo(){
        $modelo = new Modelo();

        //insert na base de dados
        $modelo->nome = 'aaa';
        $modelo->save();

        //verificar se o registo válido se encontra na BD
        $readmodelo = Modelo::findOne($modelo->id);

        $this->assertNotNull($readmodelo);
        $this->assertIsObject($readmodelo);

        //aplicar um update
        $readmodelo->nome = 'aaaa';
        $readmodelo->save();

        //verificar se o registo atualizado se encontra na BD
        $updatemodelo = Modelo::findOne(['nome' => 'aaaa']);

        $this->assertNotNull($updatemodelo);

        //apagar um registo
        $updatemodelo->delete();

        $deletemodelo = Modelo::findOne(['nome' => 'aaaa']);
        //verificar que o registo não se encontra na BD
        $this->assertNull($deletemodelo);
    }
}