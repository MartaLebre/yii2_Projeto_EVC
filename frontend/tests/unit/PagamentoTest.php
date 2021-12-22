<?php
namespace frontend\tests;

use common\models\Pagamento;
use common\models\User;

class PagamentoTest extends \Codeception\Test\Unit
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
        $pagamento = new Pagamento();

        //numero_cartao
        $pagamento->numero_cartao = '1234123412341234';
        $this->assertTrue($pagamento->validate(['numero_cartao']));

        $pagamento->numero_cartao = '123412341234123444444';
        $this->assertFalse($pagamento->validate(['numero_cartao']));

        $pagamento->numero_cartao = 'a';
        $this->assertFalse($pagamento->validate(['numero_cartao']));

        $pagamento->numero_cartao = null;
        $this->assertFalse($pagamento->validate(['numero_cartao']));

        //data_validade
        $pagamento->data_validade = '2021-12-01';
        $this->assertTrue($pagamento->validate(['data_validade']));

        $pagamento->data_validade = null;
        $this->assertFalse($pagamento->validate(['data_validade']));

        //codigo_seguranca
        $pagamento->codigo_seguranca = '123';
        $this->assertTrue($pagamento->validate(['codigo_seguranca']));

        $pagamento->codigo_seguranca = '1234';
        $this->assertFalse($pagamento->validate(['codigo_seguranca']));

        $pagamento->codigo_seguranca = '123.2';
        $this->assertFalse($pagamento->validate(['codigo_seguranca']));

        $pagamento->codigo_seguranca = 'a';
        $this->assertFalse($pagamento->validate(['codigo_seguranca']));

        $pagamento->codigo_seguranca = null;
        $this->assertFalse($pagamento->validate(['codigo_seguranca']));
    }

    public function testPagamento(){
        $user = new User();
        $pagamento = new Pagamento();

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
        $pagamento->id_user = $user->id;
        $pagamento->numero_cartao = '1234123412341234';
        $pagamento->data_validade = '2021-12-01';
        $pagamento->codigo_seguranca = '123';
        $pagamento->save();

        //verificar se o registo válido se encontra na BD
        $readpagamento = Pagamento::findOne($user->id);

        $this->assertNotNull($readpagamento);
        $this->assertIsObject($readpagamento);

        //aplicar um update
        $readpagamento->updateAttributes(['numero_cartao' => '1234123412341294']);

        //verificar se o registo atualizado se encontra na BD
        $updatepagamento = Pagamento::findOne(['numero_cartao' => '1234123412341294']);

        $this->assertNotNull($updatepagamento);

        //apagar um registo
        $updatepagamento->delete();

        $deletepagamento = Pagamento::findOne(['numero_cartao' => '1234123412341294']);
        //verificar que o registo não se encontra na BD
        $this->assertNull($deletepagamento);
    }
}