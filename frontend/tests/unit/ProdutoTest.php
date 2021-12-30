<?php
namespace frontend\tests;

use common\models\Modelo;
use common\models\Produto;

class ProdutoTest extends \Codeception\Test\Unit
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
        $produto = new Produto();

        //nome
        $produto->nome = 'teste';
        $this->assertTrue($produto->validate(['nome']));

        $produto->nome = 'aadhfjhassaljfjashgdfashdfgjashdgfjashgdfjgasjdhfasdfgasdjhfasdfasdfasdfasdfdgjshdfjhgsdjgfjshdfgjshdf';
        $this->assertFalse($produto->validate(['nome']));

        $produto->nome = 100;
        $this->assertFalse($produto->validate(['nome']));

        $produto->nome = null;
        $this->assertFalse($produto->validate(['nome']));

        //genero
        $produto->genero = 'feminino';
        $this->assertTrue($produto->validate(['genero']));

        $produto->genero = 'masculino';
        $this->assertTrue($produto->validate(['genero']));

        $produto->genero = 100;
        $this->assertFalse($produto->validate(['genero']));

        $produto->genero = null;
        $this->assertFalse($produto->validate(['genero']));

        //descricao
        $produto->descricao = 'produto descricao exemplo';
        $this->assertTrue($produto->validate(['descricao']));

        $produto->descricao = 'sdfaljshdfjashdfasjdfhjashdfjashdfasdfhasdjfhasdfjasdfhasdhfasdhfgasdfahsdfasdasdfasdsdfgjshdjfgshdfgsjdfhgsdjf';
        $this->assertFalse($produto->validate(['descricao']));

        $produto->descricao = 100;
        $this->assertFalse($produto->validate(['descricao']));

        $produto->descricao = null;
        $this->assertFalse($produto->validate(['descricao']));

        //tamanho
        $produto->tamanho = 'XS';
        $this->assertTrue($produto->validate(['tamanho']));

        $produto->tamanho = 'S';
        $this->assertTrue($produto->validate(['tamanho']));

        $produto->tamanho = 'M';
        $this->assertTrue($produto->validate(['tamanho']));

        $produto->tamanho = 'L';
        $this->assertTrue($produto->validate(['tamanho']));

        $produto->tamanho = 'XL';
        $this->assertTrue($produto->validate(['tamanho']));

        $produto->tamanho = 100;
        $this->assertFalse($produto->validate(['tamanho']));

        $produto->tamanho = null;
        $this->assertFalse($produto->validate(['tamanho']));

        //preco
        $produto->preco = 10;
        $this->assertTrue($produto->validate(['preco']));

        $produto->preco = 10.99;
        $this->assertTrue($produto->validate(['preco']));

        $produto->preco = 'a';
        $this->assertFalse($produto->validate(['preco']));

        $produto->preco = null;
        $this->assertFalse($produto->validate(['preco']));

        //quantidade
        $produto->quantidade = 20;
        $this->assertTrue($produto->validate(['quantidade']));

        $produto->quantidade = 20.20;
        $this->assertFalse($produto->validate(['quantidade']));

        $produto->quantidade = 'a';
        $this->assertFalse($produto->validate(['quantidade']));

        $produto->quantidade = null;
        $this->assertFalse($produto->validate(['quantidade']));

        //data
        $produto->data = '2021-12-14 17:41:18';
        $this->assertTrue($produto->validate(['data']));

        $produto->data = '2021-12-14';
        $this->assertTrue($produto->validate(['data']));

        $produto->data = '17:41:18';
        $this->assertTrue($produto->validate(['data']));

        $produto->data = null;
        $this->assertFalse($produto->validate(['data']));

        //foto
        $produto->foto = 'teste';
        $this->assertTrue($produto->validate(['foto']));

        $produto->foto = null;
        $this->assertTrue($produto->validate(['foto']));

        $produto->foto = 1;
        $this->assertFalse($produto->validate(['foto']));
    }


    public function testProduto(){
        $modelo = new Modelo();
        $produto = new Produto();

        //insert na base de dados
        $modelo->id = 90;
        $modelo->nome = 'modelo teste';
        $modelo->save();
        $produto->codigo_produto = 1;
        $produto->nome = 'teste';
        $produto->genero = 'masculino';
        $produto->descricao = 'descricao teste';
        $produto->tamanho = 'M';
        $produto->preco = 9.99;
        $produto->quantidade = 3;
        $produto->data = '2021-11-28 19:25:49';
        $produto->id_modelo = $modelo->id;
        $produto->foto = null;
        $produto->save();

        //verificar se o registo válido se encontra na BD
        $readproduto = Produto::findOne($produto->codigo_produto);

        $this->assertNotNull($readproduto);
        $this->assertIsObject($readproduto);

        //aplicar um update
        $readproduto->nome = 'teste2';
        $readproduto->save();

        //verificar se o registo atualizado se encontra na BD
        $updateproduto = Produto::findOne(['nome' => 'teste2']);

        $this->assertNotNull($updateproduto);

        //apagar um registo
        $updateproduto->delete();

        $deleteproduto = Produto::findOne(['nome' => 'teste2']);
        //verificar que o registo não se encontra na BD
        $this->assertNull($deleteproduto);
    }
}