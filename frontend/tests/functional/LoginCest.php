<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;

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
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->fillField('LoginForm[username]', '');
        $I->fillField('LoginForm[password]', '');
        $I->click('Login');
        $I->seeValidationError('Necessário introduzir um username.');
        $I->seeValidationError('Necessário introduzir uma password.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'wrong');
        $I->click('Login');
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkInactiveAccount(FunctionalTester $I)
    {
        $I->fillField('LoginForm[username]', 'test.test');
        $I->fillField('LoginForm[password]', 'Test1234');
        $I->click('Login');
        $I->seeValidationError('Incorrect username or password');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'cliente123');
        $I->click('Login');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
