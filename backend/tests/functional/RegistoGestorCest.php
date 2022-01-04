<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;


class RegistoGestorCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Login');
        $I->see('Gestão de utilizadores');
        $I->click('Adicionar Gestor');
        $I->see('Adicionar Gestor de Stock');
    }

    // tests
    public function checkEmpty(FunctionalTester $I)
    {
        $I->fillField('UserForm[username]', '');
        $I->fillField('UserForm[primeiro_nome]', '');
        $I->fillField('UserForm[ultimo_nome]', '');
        $I->fillField('UserForm[telemovel]', '');
        $I->fillField('UserForm[email]', '');
        $I->fillField('UserForm[password]', '');
        $I->click('Registar');
        $I->see('Necessário introduzir um username.');
        $I->see('Necessário introduzir um primeiro nome.');
        $I->see('Necessário introduzir um apelido.');
        $I->see('Necessário introduzir um número de telemóvel.');
        $I->see('Necessário introduzir um email.');
        $I->see('Necessário introduzir uma password.');
    }

    public function checkWrongEmail(FunctionalTester $I)
    {
        $I->fillField('UserForm[username]', 'teste');
        $I->fillField('UserForm[primeiro_nome]', 'teste');
        $I->fillField('UserForm[ultimo_nome]', 'teste');
        $I->fillField('UserForm[telemovel]', '988988988');
        $I->fillField('UserForm[email]', 'teste');
        $I->fillField('UserForm[password]', '123456789');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um número de telemóvel.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir uma password.', '.invalid-feedback');
        $I->see('Email incorreto.', '.invalid-feedback');
    }

    public function checkWrongTelemovel(FunctionalTester $I)
    {
        $I->fillField('UserForm[username]', 'teste');
        $I->fillField('UserForm[primeiro_nome]', 'teste');
        $I->fillField('UserForm[ultimo_nome]', 'teste');
        $I->fillField('UserForm[telemovel]', '988988');
        $I->fillField('UserForm[email]', 'teste');
        $I->fillField('UserForm[password]', '123456789');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um email.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir uma password.', '.invalid-feedback');
        $I->see('O número de telemóvel tem que ter 9 dígitos.', '.invalid-feedback');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->fillField('UserForm[username]', 'teste');
        $I->fillField('UserForm[primeiro_nome]', 'teste');
        $I->fillField('UserForm[ultimo_nome]', 'teste');
        $I->fillField('UserForm[telemovel]', '988988988');
        $I->fillField('UserForm[email]', 'teste');
        $I->fillField('UserForm[password]', '123456');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um email.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um número de telemóvel.', '.invalid-feedback');
        $I->see('Password should contain at least 8 characters.', '.invalid-feedback');
    }

    public function registoSuccessfully(FunctionalTester $I)
    {
        $I->fillField('UserForm[username]', 'teste');
        $I->fillField('UserForm[primeiro_nome]', 'teste');
        $I->fillField('UserForm[ultimo_nome]', 'teste');
        $I->fillField('UserForm[telemovel]', '988988988');
        $I->fillField('UserForm[email]', 'teste@mail.com');
        $I->fillField('UserForm[password]', '123456789');
        $I->click('Registar');
        $I->see('Lista de Utilizadores');
        $I->see('teste');
    }
}
