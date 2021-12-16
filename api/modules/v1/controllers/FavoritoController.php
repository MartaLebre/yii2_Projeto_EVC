<?php

namespace api\modules\v1\controllers;

use common\models\Favorito;
use yii\rest\ActiveController;


class FavoritoController extends ActiveController
{
    public $modelClass = 'common\models\Favorito';

}