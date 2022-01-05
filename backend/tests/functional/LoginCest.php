<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    /**
     * @param FunctionalTester $I
     */

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'wrong');
        $I->click('Login');
        $I->dontsee('Incorrect username or password.', '.invalid-feedback');
    }

    public function loginUserAdmin(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Login');

        $I->see('Gestão de Utilizadores');
        $I->dontSeeLink('Login');
        $I->see('LOGOUT');
    }

    public function loginUserGestor(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'gestor');
        $I->fillField('LoginForm[password]', 'gestor123');
        $I->click('Login');

        $I->see('Gestão de Produtos');
        $I->see('Gestão de Encomendas');
        $I->dontSeeLink('Login');
        $I->see('LOGOUT');
    }

    public function loginUserCliente(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'cliente123');
        $I->click('Login');

        $I->see('Iniciar sessão');
    }
}
