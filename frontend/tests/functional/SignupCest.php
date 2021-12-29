<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class SignupCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/signup'));
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Registo');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('SignupForm[username]', '');
        $I->fillField('SignupForm[primeiro_nome]', '');
        $I->fillField('SignupForm[ultimo_nome]', '');
        $I->fillField('SignupForm[telemovel]', '');
        $I->fillField('SignupForm[email]', '');
        $I->fillField('SignupForm[password]', '');
        $I->click('Registar');
        $I->seeValidationError('Necessário introduzir um username.');
        $I->seeValidationError('Necessário introduzir um primeiro nome.');
        $I->seeValidationError('Necessário introduzir um apelido.');
        $I->seeValidationError('Necessário introduzir um número de telemóvel.');
        $I->seeValidationError('Necessário introduzir um email.');
        $I->seeValidationError('Necessário introduzir uma password.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->fillField('SignupForm[username]', 'teste');
        $I->fillField('SignupForm[primeiro_nome]', 'teste');
        $I->fillField('SignupForm[ultimo_nome]', 'teste');
        $I->fillField('SignupForm[telemovel]', '988988988');
        $I->fillField('SignupForm[email]', 'teste');
        $I->fillField('SignupForm[password]', '123456789');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um número de telemóvel.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir uma password.', '.invalid-feedback');
        $I->see('Email incorreto.', '.invalid-feedback');
    }

    public function signupWithWrongTelemovel(FunctionalTester $I)
    {
        $I->fillField('SignupForm[username]', 'teste');
        $I->fillField('SignupForm[primeiro_nome]', 'teste');
        $I->fillField('SignupForm[ultimo_nome]', 'teste');
        $I->fillField('SignupForm[telemovel]', '988988');
        $I->fillField('SignupForm[email]', 'teste');
        $I->fillField('SignupForm[password]', '123456789');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um email.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir uma password.', '.invalid-feedback');
        $I->see('O número de telemóvel tem que ter 9 dígitos.', '.invalid-feedback');
    }

    public function signupWithWrongPassword(FunctionalTester $I)
    {
        $I->fillField('SignupForm[username]', 'teste');
        $I->fillField('SignupForm[primeiro_nome]', 'teste');
        $I->fillField('SignupForm[ultimo_nome]', 'teste');
        $I->fillField('SignupForm[telemovel]', '988988988');
        $I->fillField('SignupForm[email]', 'teste');
        $I->fillField('SignupForm[password]', '123456');
        $I->click('Registar');
        $I->dontSee('Necessário introduzir um username.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um primeiro nome.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um apelido.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um email.', '.invalid-feedback');
        $I->dontSee('Necessário introduzir um número de telemóvel.', '.invalid-feedback');
        $I->see('Password should contain at least 8 characters.', '.invalid-feedback');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->fillField('SignupForm[username]', 'teste');
        $I->fillField('SignupForm[primeiro_nome]', 'teste');
        $I->fillField('SignupForm[ultimo_nome]', 'teste');
        $I->fillField('SignupForm[telemovel]', '988988988');
        $I->fillField('SignupForm[email]', 'teste@mail.com');
        $I->fillField('SignupForm[password]', '123456789');
        $I->click('Registar');

        $I->seeRecord('common\models\User', [
            'username' => 'teste',
            'email' => 'teste@mail.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->see('Registo efetuado com sucesso.');
    }
}
