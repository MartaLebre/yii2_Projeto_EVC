<?php
namespace frontend\tests;

use common\models\Encomenda;
use common\models\User;

class EncomendaTest extends \Codeception\Test\Unit
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
        $encomenda = new Encomenda();

        //estado
        $encomenda->estado = 'carrinho';
        $this->assertTrue($encomenda->validate(['estado']));

        $encomenda->estado = 'pendente';
        $this->assertTrue($encomenda->validate(['estado']));

        $encomenda->estado = 'em processamento';
        $this->assertTrue($encomenda->validate(['estado']));

        $encomenda->estado = 'enviado';
        $this->assertTrue($encomenda->validate(['estado']));

        $encomenda->estado = 'entregue';
        $this->assertTrue($encomenda->validate(['estado']));

        $encomenda->estado = 10;
        $this->assertFalse($encomenda->validate(['estado']));

        $encomenda->estado = null;
        $this->assertFalse($encomenda->validate(['estado']));

        //data
        $encomenda->data = '2021-10-02';
        $this->assertTrue($encomenda->validate(['data']));

        $encomenda->data = null;
        $this->assertFalse($encomenda->validate(['data']));
    }

    public function testEncomenda()
    {
        $user = new User();
        $encomenda = new Encomenda();

        //insert na base de dados
        $user->id = 90;
        $user->username = 'abilio';
        $user->auth_key = '2t7jC06i3xBxyqsgpBsjHcsQ2LHYsDHF';
        $user->password_hash = '$2y$13$v79XQb6wxfliv5a7rY8MzO9idYm3QnW8c5ulA.N.RKBafWl44lJTK';
        $user->email = 'abilio@mail.com';
        $user->status = 10;
        $user->created_at = 1634298813;
        $user->updated_at = 1634298813;
        $user->verification_token = 'OtB5nwgY2WdSrIl0j5wgX6eMQzpZ-poV_1634298813';
        $user->save();
        $encomenda->id = 1;
        $encomenda->estado = 'carrinho';
        $encomenda->data = '2021-10-20';
        $encomenda->id_user = $user->id;
        $encomenda->save();

        //verificar se o registo válido se encontra na BD
        $readencomenda = Encomenda::findOne($encomenda->id);

        $this->assertNotNull($readencomenda);
        $this->assertIsObject($readencomenda);

        //aplicar um update
        $readencomenda->updateAttributes(['data' => '2021-10-21']);

        //verificar se o registo atualizado se encontra na BD
        $updateEncomenda = Encomenda::findOne(['data' => '2021-10-21']);

        $this->assertNotNull($updateEncomenda);

        //apagar um registo
        $updateEncomenda->delete();

        $deleteEncomenda = Encomenda::findOne(['data' => '2021-10-21']);
        //verificar que o registo não se encontra na BD
        $this->assertNull($deleteEncomenda);
    }
}