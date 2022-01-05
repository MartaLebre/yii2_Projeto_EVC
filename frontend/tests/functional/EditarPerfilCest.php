<?php
namespace frontend\tests\functional;

use common\fixtures\PerfilFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class EditarPerfilCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'perfil' => [
                'class' => PerfilFixture::className(),
                'dataFile' => codecept_data_dir() . 'perfil_data.php',
            ]
        ];
    }
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'cliente123');
        $I->click('Login');
        $I->click('#editar');
        $I->see('Perfil');
        $I->see('Por favor preencha os seguintes campos');
    }

    // tests
    /*public function checkEditarPerfilEmpty(FunctionalTester $I)
    {
        $I->fillField('User[username]', '');
        $I->fillField('Perfil[primeiro_nome]', '');
        $I->fillField('Perfil[ultimo_nome]', '');
        $I->fillField('Perfil[telemovel]', '');
        $I->fillField('User[email]', '');
        $I->click('Atualizar');
        $I->see('Necessário introduzir um username.');
        $I->see('Necessário introduzir um primeiro nome.');
        $I->see('Necessário introduzir um apelido.');
        $I->see('Necessário introduzir um número de telemóvel.');
        $I->see('Necessário introduzir um email.');
    }

    public function checkEditarPerfilWrongMail(FunctionalTester $I)
    {
        $I->fillField('User[username]', 'cliente');
        $I->fillField('Perfil[primeiro_nome]', 'antonio');
        $I->fillField('Perfil[ultimo_nome]', 'lopes');
        $I->fillField('Perfil[telemovel]', '911944955');
        $I->fillField('User[email]', 'teste');
        $I->click('Atualizar');
        $I->dontSee('Necessário introduzir um username.');
        $I->dontSee('Necessário introduzir um primeiro nome.');
        $I->dontSee('Necessário introduzir um apelido.');
        $I->dontSee('Necessário introduzir um número de telemóvel.');
        $I->see('Email incorreto');
    }

    public function checkEditarPerfilWrongTelemovel(FunctionalTester $I)
    {
        $I->fillField('User[username]', 'cliente');
        $I->fillField('Perfil[primeiro_nome]', 'antonio');
        $I->fillField('Perfil[ultimo_nome]', 'lopes');
        $I->fillField('Perfil[telemovel]', '922');
        $I->fillField('User[email]', 'teste@mail.com');
        $I->click('Atualizar');
        $I->dontSee('Necessário introduzir um username.');
        $I->dontSee('Necessário introduzir um primeiro nome.');
        $I->dontSee('Necessário introduzir um apelido.');
        $I->dontSee('Necessário introduzir um email.');
        $I->see('O número de telemóvel tem que ter 9 dígitos.');
    }*/

    public function checkEditarPerfil(FunctionalTester $I)
    {
        $I->fillField('User[username]', 'cliente');
        $I->fillField('Perfil[primeiro_nome]', 'antonio');
        $I->fillField('Perfil[ultimo_nome]', 'lopes');
        $I->fillField('Perfil[telemovel]', '911944955');
        $I->fillField('User[email]', 'teste@mail.com');
        $I->click('Atualizar');
        $I->see('Dados atualizados com sucesso.');
    }
}
