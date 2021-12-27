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
        $I->amOnPage(Url::toRoute('/site/index'));
    }

    public function checkFavSemLogin(FunctionalTester $I)
    {
        $I->see('Novidades');
        $I->click('Novidades');
        $I->see('hoodie teste');
        $I->click('.far fa-heart icon-favorito');
        $I->see('Iniciar sessão');
    }
}
