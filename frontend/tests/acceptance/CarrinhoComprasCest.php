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

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('Login');
    }

    public function checkCarrinho(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->wait(3);

        $I->see('Novidades');
        $I->click('Novidades');

        $I->wait(3);
        $I->see('hoodie teste');
        $I->click('Ver Produto');
        $I->wait(3);
        $I->click('Adicionar ao Carrinho de Compras');
        $I->see('hoodie teste foi adicionado ao seu carrinho.');
        $I->wait(3);
        $I->click('#carrinhoindex');
        $I->see('hoodie teste');
        $I->wait(3);

    }
}
