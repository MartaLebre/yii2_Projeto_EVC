<?php
namespace frontend\tests\functional;

use common\fixtures\ModeloFixture;
use common\fixtures\ProdutoFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class FavoritoCest
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

    public function checkFav(FunctionalTester $I)
    {
        //adicionar favorito
        $I->see('Novidades');
        $I->click('Novidades');
        $I->see('hoodie teste');
        $I->click('#fav');
        $I->see('hoodie teste foi adicionado à sua lista de favoritos.');

        //ver index de favoritos
        $I->click('#favindex');
        $I->see('hoodie teste');

        //remover favorito
        /*$I->see('hoodie teste');
        $I->click('Favorito');
        $I->see('hoodie teste foi removido da sua lista de favoritos.');*/
    }
}
