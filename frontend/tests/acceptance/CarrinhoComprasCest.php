<?php

namespace frontend\tests\acceptance;

use common\fixtures\ModeloFixture;
use common\fixtures\ProdutoFixture;
use common\fixtures\UserFixture;
use frontend\tests\AcceptanceTester;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class CarrinhoComprasCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'modelo' => [
                'class' => ModeloFixture::className(),
                'dataFile' => codecept_data_dir() . 'modelo_data.php',
            ],
            'produto' => [
                'class' => ProdutoFixture::className(),
                'dataFile' => codecept_data_dir() . 'produto_data.php',
            ],
        ];
    }

    public function checkCarrinho(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('Login');
        $I->wait(3);

        $I->see('Novidades');
        $I->click('Novidades');

        $I->wait(3);
        $I->see('hoodie teste');
        $I->click('Ver Produto');
        $I->wait(3);
        $I->click('Adicionar ao Carrinho de compras');
        $I->see('hoodie teste foi adicionado ao seu carrinho.');

        $I->wait(3);
        $I->click('#carrinhoindex');
        $I->see('hoodie teste');
        $I->wait(3);
        $I->click('#add');
        $I->click('#add');
        $I->wait(3);
        $I->click('Finalizar Compra');

        $I->wait(3);
        $I->see('Faturação:');
        $I->see('Por favor preencha os seguintes campos:');
        $I->fillField('Faturacao[localidade]', 'figueira');
        $I->fillField('Faturacao[primeiro_nome]', 'marta');
        $I->fillField('Faturacao[ultimo_nome]', 'lebre');
        $I->fillField('Faturacao[codigo_postal]', '3400');
        $I->fillField('Faturacao[nif]', '123456789');
        $I->fillField('Faturacao[morada_faturacao]', 'rua de teste');
        $I->click('Continuar');

        $I->wait(3);
        $I->see('Pagamento:');
        $I->see('Por favor preencha os seguintes campos:');
        $I->fillField('Pagamento[numero_cartao]', '1234567891234567');
        $I->fillField('Pagamento[data_validade]', '2021-01-02');
        $I->fillField('Pagamento[codigo_seguranca]', '123');
        $I->click('Finalizar');

        $I->wait(3);
        $I->see('Obrigado pela sua compra! Para mais informações sobre o estado da sua encomenda aceda à área "Minhas Encomendas"!');

        $I->click('Novidades');
        $I->wait(3);

        $I->click('#carrinhoindex');
        $I->wait(3);

        $I->click('#encomendaindex');
        $I->wait(3);
    }
}
